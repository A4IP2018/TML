<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;

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
        //
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

        $path = public_path() . '/files/';
        $image = $request->file('fileToUpload');

        $filename = time() . '.' . $image->getClientOriginalName();
        $fileType = $request->file('fileToUpload')->getClientOriginalExtension();
        $fileExtension = $request->file('fileToUpload')->guessExtension();

        $user_id = Auth::id();

        if ($user_id == null) {
            return redirect('/login')->withErrors('Trebuie sa fiti autentificat pentru a uploada o tema.');
        }

        if ($fileType != $fileExtension) {
            return redirect()->back()->withErrors('Fisier invalid: extensia nu corespunde cu continutul.');
        }
        $homework_id = $request->input('homework-id');
        $extension_string = \App\Extension::where('id', $homework_id)->pluck('extensions_string')->toArray();
        $extensions = explode('.', $extension_string[0]);
        $extensionOk = 0;
        foreach ($extensions as $extension) {
            if ($extension == $fileType) {
                $extensionOk = 1;
                break;
            }
        }

        if ($extensionOk == 0) {
            return redirect()->back()->withErrors('Extensie neacceptata.');
        }

        if ($request->file('fileToUpload')->getClientSize() > 500000) {
            return redirect()->back()->withErrors('Fisierul este prea mare.');
        }

        if ($image->move($path, $filename)) {

            \App\File::create([
                'user_id' => $user_id,
                'homework_id' => $homework_id,
                'file_name' => $filename
            ]);
            return redirect()->back()->withErrors('Fisier uploadat cu succes.');
        } else {
            return redirect()->back()->withErrors('Eroare la upload.');
            }
    }
}
