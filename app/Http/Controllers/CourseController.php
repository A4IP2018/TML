<?php

namespace App\Http\Controllers;

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
}
