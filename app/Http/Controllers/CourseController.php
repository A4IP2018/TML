<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\UserCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon as Carbon;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    public function get_teacher_names($course) {
        $teachers_string = null;
        if (!is_null($course->users))
        {
            $teachers_string = implode(", ", $course->users
                ->map(function($user) {
                    if (!is_null($user->teacher_information)) {
                        return $user->teacher_information->name;
                    }
                    return null;
                })
                ->filter(function($str) { return is_null($str) ? false : true; })
                ->toArray());

        }
        if (is_null($teachers_string)) {
            $teachers_string = 'Nici un profesor specificat';
        }
        return $teachers_string;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }

    /**
     * Display a one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $course = Course::where('slug', $slug)->first();
        $elapsed_time = Carbon::parse($course->created_at);

        return view('course-details')->with(['course' => $course, 'elapsed_time' => $elapsed_time->diffForHumans(), 'teachers_string' => $this->get_teacher_names($course)]);
    }

    /**
     * Display the editing page of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {

        $course = Course::where('slug', $slug)->first();

        return view('edit-course', compact('course'));
    }

    /**
     * Update one resource
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug) {
        // TODO Validate input properly
        $course = Course::where('slug', $slug)->first();
        $course->course_title = Input::get('course_title');
        $course->year = Input::get('year_select');
        $course->semester = Input::get('semester_select');
        $course->description = Input::get('course_descr');

        $course_teachers = Input::get('course_teach');
        $teachers = explode(", ", $course_teachers);

        $course->save();

        return redirect('/course');
    }

    /**
     * Display the creation page of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('new-course');
    }

    /**
     * Add resource to database
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        // TODO validate input properly
        $course = new Course();
        $course->course_title = Input::get('course_title');
        $course->year = Input::get('year_select');
        $course->semester = Input::get('semester_select');
        $course->description = Input::get('course_descr');
        $course->credits = 0;
        $course->slug = str_slug($course->year . '_' . $course->semester . '_' . $course->course_title);

        $course->save();

        \DB::table('teacher_course')->insert([
            'course_id' => $course->id,
            'user_id' => Auth::id()
        ]);

        return redirect('/course');
    }


    public function subscribe($slug) {
        $course_id = Course::where('slug', $slug)->first()->id;
        $current_user = User::where('id', Auth::id())->first();

        if (!in_array($course_id, $current_user->subscribed->pluck('id')->toArray()))
        {
            $new_entry = new UserCourse();
            $new_entry->user_id = $current_user->id;
            $new_entry->course_id = $course_id;
            $new_entry->save();
        }

        return redirect()->back();
    }
}
