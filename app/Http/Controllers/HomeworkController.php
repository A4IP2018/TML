<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Course;
use App\Format;
use App\Homework;

use App\Role;
use App\StudentInformation;

use App\TeacherCourse;
use App\User;
use App\Grade;
use App\HomeworkEvent;
use App\RequiredFormat;
use App\Http\Controllers\NotificationController as Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Session;

class HomeworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createEvent($homework, $attribute, $from, $to) {
        $user = User::where('id', Auth::id())->first();
        HomeWorkEvent::create([
            'homework_id' => $homework->id,
            'user_id' => Auth::id(),
            'event' => 'Utilizatorul <span class="badge">' . $user->teacher_information->name .
                '</span> a modificat <span class="badge">' . $attribute . '</span> de la ' .
                '<span class="badge">' . $from . '</span> ' .
                'la <span class="badge">' . $to  . '</span>'
         ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeworks = Homework::
            whereHas('course.subscriptions', function ($query) {
                $query->where ('users.id', Auth::id());
            })
            ->withCount('grades')
            ->withCount('files')
            ->with('user', 'user.subscribed')
            ->orderBy('deadline')
            ->get();

        return view('homework', compact('homeworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() and Auth::user()->courses->count() == 0) {
            Session::flash('error', 'Trebui&#259; sa creezi un <a href="'. url('/course/create') .'">curs</a>, pentru a ad&#259;uga o tem&#259;');
            return redirect()->back();
        }
        $formats = Format::all();

        $currentTeacher = User::where('id', Auth::id())->whereHas('role', function ($query) {
            $query->where('rank', Role::$TEACHER_RANK);
        })->first();

        if ($currentTeacher) {
            $teacherCourses = $currentTeacher->courses;

            return view('new-homework', compact('formats', 'currentTeacher', 'teacherCourses'));
        }

        else {
            return redirect()->back();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'deadline' => 'required',
            'file.*.file_description' => 'required|max:240',
            'file.*.file_format' => 'required'
        ]);

        $selectedFormats = $request->input('format');
        $deadline = $request->input('deadline');
        $description = $request->input('description');
        $course = $request->input('course');
        $title = $request->input('name');

        $slug = str_slug($title);
        $count = Homework::where('slug', $slug)->count();

        $slug = $count > 0 ? ($slug . '-' . ($count + 1)) : $slug;

        $homework = Homework::create([
            'course_id' => $course,
            'name' => $title,
            'description' => $description,
            'slug' => $slug,
            'category_id' => 1,
            'user_id' => Auth::id(),
            'deadline' => $deadline,
        ]);


        $files = $request->input('file');
        foreach($files as $file) {
            if (Format::where('id', $file['file_format'])->count() > 0) {
                $format = RequiredFormat::create([
                    'homework_id' => $homework->id,
                    'format_id' => $file['file_format'],
                    'description' => $file['file_description']
                ]);
            }

        }

        Session::flash('success', 'Tema a fost creat&#259;!');
        return redirect('/homework/' . $homework->slug);

        return redirect()->back()->withErrors($validator);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $homework = Homework::where('slug', $slug)->with('formats')->first();

        $comments = Comment::where('homework_id', $homework->id)
            ->with('user', 'user.student_information')
            ->orderBy('id', 'desc')
            ->get();

        $events = $homework->events->all();

        return view('homework-details', compact('comments', 'homework', 'events'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $formats = Format::all();
        $homework = Homework::where('slug', $slug)->with('formats')->first();
        $required_formats = $homework->requirements->all();

        $currentTeacher = User::where('id', Auth::id())->whereHas('role', function ($query) {
            $query->where('rank', Role::$TEACHER_RANK);
        })->first();
        if (is_null($currentTeacher)) {
            Session::flash('error', 'Nu esti profesorul acestui curs!');
            return redirect()->back();
        }

        if (is_course_teacher($homework->course->id)) {
            $teacherCourses = $currentTeacher->courses;
            return view('edit-homework', compact('homework', 'formats', 'required_formats', 'teacherCourses'));
        }
        else {
            Session::flash('error', 'Trebuie sa fii profesorul cursului ' . $homework->course->course_title . ' pentru a-l edita');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = $this->validate($request, [
            'deadline' => 'required',
        ]);


        $currentHomework = Homework::where('slug', $slug)->first();

        $deadline = $request->input('deadline');

        if ($deadline != $currentHomework->deadline) {
            if ($deadline < $currentHomework->deadline) {
                Session::flash('error', 'Termenul limita nu poate fi mic&#x219;orat');
                return redirect()->back();
            }
            $this->createEvent($currentHomework, 'termenul limita', $currentHomework->deadline, $deadline);
        }

        $homework = Homework::updateOrCreate(['id' => $currentHomework->id],  [
            'deadline' => $deadline,
        ]);

        Session::flash('success', 'Tema a fost modificat&#259; cu succes');

        $subscribed_users = $currentHomework->course->subscriptions->pluck('id')->toArray();

        send_notification(
            $subscribed_users,
            'Tema ' . '<a href="' . url('/homework/' . $currentHomework->slug) . '">' . $currentHomework->name . '</a> a fost modificat&#259;'
        );
        return redirect()->route('homework.edit', $slug)->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

    /**
     * Upload comment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadComment(Request $request)
    {
        $validator = $this->validate($request, [
                        'comments' => 'required|min:5|max:60000',
                    ]);
        $comment = $request->input('comments');
        $homeworkId = $request->input('homework-id');

        Comment::create([
            'comment' => $comment,
            'homework_id' => $homeworkId,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();

    }


    /**
     * Teacher gives/updates grade
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function updateGrade(Request $request)
    {
        $validator = $this->validate($request, [
            'grade' => 'required|integer|between:1,10'
        ]);

        $fileId = $request->input('homework-id');
        $grade = $request->input('grade');
        $userId = $request->input('user-id');

        Grade::updateOrCreate( ['file_id' => $fileId, 'user_id' => $userId], [
            'grade' => $grade
        ]);

        return redirect()->back()->withErrors($validator);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentUploadsView()
    {
        $files = \App\File::with('user', 'homework', 'user.student_information')->orderBy('id', 'desc')->get();
        return view('stud-uploads', compact('files'));
    }

    /**
     * @param $userId
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentUploadView($userId, $slug)
    {
        $user = User::find($userId);
        $homework = Homework::with('course', 'file')->where('slug', $slug)->first();
        $grade = Grade::where('user_id', $user->id)->where('homework_id', $homework->id)->first();

        return view('stud-uploads-sg', compact('homework', 'user', 'grade'));
    }


    public function download($fileName)
    {
        $path = public_path() . '/files/';

        return response()->download($path . $fileName);
    }

    public function compare()
    {
        $files = \App\File::all();
        return view('compare', compact('files'));
    }

    public function compareAction(Request $request)
    {

        $firstFile = $request->input('first-compare-field');
        $secondFile = $request->input('second-compare-field');

        $firstFile = \App\File::find($firstFile);
        $secondFile = \App\File::find($secondFile);

        $content1 = File::get(public_path('files/' . $firstFile->file_name));
        $content2 = File::get(public_path('files/' . $secondFile->file_name));


        $procent = plagiarism_check($content1, $content2);

        return redirect()->back()->with(compact('procent'));

    }

    public function getFilteredHomeworks(Request $request)
    {
        $searchedCourse = $request->input('courseFilter') && (int) $request->input('courseFilter') !== -1 ? (int)$request->input('courseFilter') : null;
        $uncheckedHomework = $request->input('uncheckedHomeworkFilter') ? (int)$request->input('uncheckedHomeworkFilter') : null;
        $homeworkSearch = $request->input('homeworkSearchFilter') ? $request->input('homeworkSearchFilter') : null;

        $homeworks = Homework::
            when($searchedCourse, function ($collection) use ($searchedCourse) {
                return $collection->whereHas('course', function($query) use($searchedCourse) {
                    return $query->where('course_id', $searchedCourse);
                });
            })
            ->withCount('grades')
            ->withCount('files')
            ->when($uncheckedHomework, function ($collection) use ($uncheckedHomework) {
                return $collection->doesntHave('files.grade');
            })
            ->when($homeworkSearch, function ($collection) use ($homeworkSearch) {
                return $collection->where('name', 'LIKE', '%'.$homeworkSearch.'%');
            })
            ->whereHas('course.subscriptions', function ($query) {
                $query->where('users.id', Auth::id());
            })

            ->with('user', 'user.subscribed', 'course')
            ->orderBy('deadline')
            ->get();

        foreach ($homeworks as $homework) {
            $homework['course_link'] = url('/course/' .$homework->course->slug);
            $homework['is_homework_author'] = Auth::check() && is_homework_author($homework);
            $homework['homework_link'] = url('/homework/' . $homework->slug);
            $homework['homework_edit'] = url('/homework/' . $homework->slug . '/edit');
            $homework['unchecked_homework_link'] = url('/uploads/unchecked/' . $homework->slug);
            $homework['checked_homework_link'] = url('/uploads/checked/' . $homework->slug);
        }

        return $homeworks;
    }

}