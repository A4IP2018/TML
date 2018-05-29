<?php

namespace App\Http\Controllers;

use App\Course;
use App\Grade;
use App\Role;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Code;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Contact;

class AdminController extends Controller
{
    public function index() {
        while (Code::where('rank', \App\Role::$TEACHER_RANK)->count() < 10) {
            Code::create([
               'code' => generate_random_string(10),
                'rank' => \App\Role::$TEACHER_RANK
            ]);
        }
        while (Code::where('rank', \App\Role::$ADMINISTRATOR_RANK)->count() < 10) {
            Code::create([
                'code' => generate_random_string(10),
                'rank' => \App\Role::$ADMINISTRATOR_RANK
            ]);
        }

        $teacher_codes = Code::where('rank', \App\Role::$TEACHER_RANK)->get();
        $admin_codes = Code::where('rank', \App\Role::$ADMINISTRATOR_RANK)->get();
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return view('admin')->with(['teacher_codes' => $teacher_codes, 'admin_codes' => $admin_codes, 'contacts' => $contacts]);
    }

    public function studentsPassedStatistics($course, $meta)
    {
        return Course::where('id', $course->id)->whereHas('homeworks.grades', function($query) use ($meta) {
            $query
                ->when($meta === 'failed', function ($collection) {
                    $collection->where('grades.grade', '<=', 4);
                })
                ->when($meta === 'passed', function ($collection) {
                    $collection->where('grades.grade', '>=', 5);
                });


        })->count();
    }

    public function pdfGenerate()
    {
        $dir = storage_path() . '/fonts';

        if (!file_exists($dir) && !is_dir($dir)) {
            mkdir($dir);
        }

        $grades = Grade::with('file', 'file.homework', 'file.homework.course')->where('user_id', Auth::id())->get();

        $myCourses = Course::whereHas('subscriptions', function($query) {
            return $query->where('user_id', Auth::id());
        })
            ->withCount('homeworks')
            ->with('users', 'users.teacher_information')->get();

        $allGrades = Grade::with('file.user.student_information', 'file.homework.course', 'file.user.teacher_information')->get();

        foreach($myCourses as $myCourse) {

            $numberOfStudentSubscriptions = Course::
                where('id', $myCourse->id)
                ->whereHas('subscriptions.role', function($collection) {
                    $collection->where('rank', Role::$MEMBER_RANK);
                })
                ->count();

            $myCourse->teacherNames = get_teacher_names($myCourse);

            $myCourse->failedStudents = $this->studentsPassedStatistics($myCourse, 'failed');
            $myCourse->passedStudents = $this->studentsPassedStatistics($myCourse, 'passed');
            $myCourse->subscriptionsStudents = $numberOfStudentSubscriptions;

        }

        $pdf = \PDF::loadView('pdf.pdf-generate', compact('grades', 'myCourses', 'allGrades'));

        return $pdf->download('pdf-generate.pdf');
//        return view('pdf.pdf-generate');
    }
}
