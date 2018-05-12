<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Homework;
use App\User;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeworks = Homework::all();
        return view('homework', compact('homeworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-homework');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $homework = Homework::where('slug', $slug)->first();
        $comments = Comment::where('homework_id', $homework->id)->get();

        return view('homework-sg', compact('comments', 'homework'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('edit-homework');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Upload view return
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadView($slug)
    {
        $homework = Homework::where('slug', $slug)->first();

        return view('upload', compact('homework'));
    }

    /**
     * Upload comment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadComment(Request $request)
    {
        $comment = $request->input('comments');
        $homeworkId = $request->input('homework-id');

        Comment::create([
            'comment' => $comment,
            'homework_id' => $homeworkId,
            'users_id' => Auth::id()
        ]);

        return redirect()->back();

    }


    /**
     * Upload homework functionality
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadHomework(Request $request)
    {

        $path = public_path(). '/files/';
        $image =  $request->file('fileToUpload');

        $filename = time() . '.' . $image->getClientOriginalName();
        $uploadOk = 1;
        $imageFileType = $request->file('fileToUpload')->getMimeType();
        $imageFileExtension = $request->file('fileToUpload')->getExtension();


        if ($request->file('fileToUpload')->getSize() > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != 'text/plain'
            && $imageFileExtension != 'txt' && $imageFileExtension != 'jpg'
            && $imageFileExtension != 'png' && $imageFileExtension != 'jpeg' && $imageFileExtension != 'gif') {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        } else {
            if ($image->move($path, $filename)) {

                \App\File::create([
                   'user_id' => Auth::id(),
                   'homework_id' => $request->input('homework-id'),
                   'file_name' =>  $filename
                ]);

                return redirect()->back();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    /**
     * Teacher gives/updates grade
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function updateGrade(Request $request)
    {
        $homeworkId = $request->input('homework-id');
        $grade = $request->input('grade');
        $userId = $request->input('user-id');

        Grade::create([
            'grade' => $grade,
            'user_id' => $userId,
            'homework_id' => $homeworkId
        ]);

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentUploadsView()
    {
        $files = \App\File::all();
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
        $homework = Homework::where('slug', $slug)->first();
        $grade = Grade::where('user_id', $user->id)->where('homework_id', $homework->id)->first();

        return view('stud-uploads-sg', compact('homework', 'user', 'grade'));
    }
}