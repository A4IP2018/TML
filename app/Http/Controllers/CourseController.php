<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
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

    public function show($slug) {
        $course = Course::get()->where('slug', $slug)->first();
        return view('course-details', compact('course'));
    }

    public function edit($slug) {
        $course = Course::get()->where('slug', $slug)->first();
        return view('edit-course', compact('course'));
    }

    public function update($slug) {
        // TODO Validate input properly
        $course = Course::get()->where('slug', $slug)->first();
        $course->course_title = Input::get('course_title');
        $course->year = Input::get('year_select');
        $course->semester = Input::get('semester_select');
        $course->description = Input::get('course_descr');

        $course_teachers = Input::get('course_teach');
        $teachers = explode(", ", $course_teachers);

        $course->save();

        return redirect('/course');
    }
}
