<?php

namespace App\Http\Controllers;

use App\Course;
use App\Grade;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Code;
use Illuminate\Support\Facades\Auth;
use Session;

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
        return view('admin')->with(['teacher_codes' => $teacher_codes, 'admin_codes' => $admin_codes]);
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

        foreach($myCourses as $myCourse) {
            $myCourse->teacherNames = get_teacher_names($myCourse);
        }

        $pdf = \PDF::loadView('pdf.pdf-generate', compact('grades', 'myCourses'));

        return $pdf->download('pdf-generate.pdf');
//        return view('pdf.pdf-generate');
    }
}
