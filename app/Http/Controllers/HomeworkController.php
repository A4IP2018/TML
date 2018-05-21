<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Format;
use App\Homework;

use App\Role;
use App\StudentInformation;

use App\TeacherCourse;
use App\User;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HomeworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeworks = Homework::whereHas('course.subscriptions', function ($query) {
            $query->where ('users.id', Auth::id());
        })->with('user', 'user.subscribed')->orWhere('user_id', Auth::id())->get();

        return view('homework', compact('homeworks'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'format' => 'required',
        ]);

        $selectedFormats = $request->input('format');
        $deadline = $request->input('deadline');
        $description = $request->input('description');
        $course = $request->input('course');
        $title = $request->input('name');

        $slug = str_slug($title);
        $count = Homework::where('slug', $slug)->count();

        $slug = $count > 0 ? ($slug . '-' . ($count + 1)) : $slug;

        $formats = Format::whereIn('id', $selectedFormats)->get();

        $homework = Homework::create([
            'course_id' => $course,
            'name' => $title,
            'description' => $description,
            'slug' => $slug,
            'category_id' => 1,
            'user_id' => Auth::id(),
            'deadline' => $deadline,
        ]);

        $homework->formats()->sync($formats);

        return redirect()->back()->withErrors($validator);

    }

    public function getFilteredHomeworks(Request $request)
    {
        $searchedYear = $request->input('yearFilter') ? (int)$request->input('yearFilter') : null;
        $searchedSemester = $request->input('semesterFilter') ? (int)$request->input('semesterFilter') : null;
        $searchedVerified = $request->input('verifiedFilter') ? (int)$request->input('verifiedFilter') : null;

        $homework = Homework::
            join('courses','homeworks.course_id','=','courses.id')
            ->when($searchedYear, function ($collection) use ($searchedYear) {
                return $collection->where('year', $searchedYear);
            })
            ->when($searchedSemester, function ($collection) use ($searchedSemester) {
                return $collection->where('semester', $searchedSemester);
            })
            ->when($searchedVerified == 0, function ($collection) use ($searchedVerified) {
                return $collection->doesntHave('grades');
            })
            ->when($searchedVerified == 1, function ($collection) use ($searchedVerified) {
                return $collection->has('grades');
            })
            ->select('homeworks.*','homeworks.slug as hslug','courses.slug as cslug','courses.course_title as cname')
            ->with('grades')
            ->get();

        return $homework;

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
        return view('homework-details', compact('comments', 'homework'));

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

        $currentTeacher = User::where('id', Auth::id())->whereHas('role', function ($query) {
            $query->where('rank', Role::$TEACHER_RANK);
        })->first();

        if ($currentTeacher) {
            $teacherCourses = $currentTeacher->courses;

            return view('edit-homework', compact('homework', 'formats', 'currentTeacher', 'teacherCourses'));
        }

        else {
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'deadline' => 'required',
            'course'=>'required',
            'format' => 'required',
        ]);


        $currentHomework = Homework::where('slug', $slug)->first();
      
        $selectedFormats = $request->input('format');
        $deadline = $request->input('deadline');
        $description = $request->input('description');
        $course = $request->input('course');
        $title = $request->input('name');

        $slug = str_slug($title);
        $count = Homework::where('slug', $slug)->where('id', '!=', $currentHomework->id)->count();

        $slug = $count > 0 ? ($slug . '-' . ($count + 1)) : $slug;

        $formats = Format::whereIn('id', $selectedFormats)->get();


        $homework = Homework::updateOrCreate(['id' => $currentHomework->id],  [
            'course_id' => $course,
            'name' => $title,
            'description' => $description,
            'slug' => $slug,
            'category_id' => 1,
            'user_id' => Auth::id(),
            'deadline' => $deadline,
        ]);

        $homework->formats()->sync($formats);


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

        $homeworkId = $request->input('homework-id');
        $grade = $request->input('grade');
        $userId = $request->input('user-id');

        Grade::updateOrCreate( ['homework_id' => $homeworkId, 'user_id' => $userId], [
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

}