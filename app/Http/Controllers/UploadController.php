<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FileSystem;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $files = \App\File::where('user_id', Auth::id())->get();
            return view('uploaded-files', compact('files'));
        }
        else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'fileToUpload' => 'required',

        ]);
        $path = public_path() . '/files/';
        $file = $request->file('fileToUpload');

        if ($file == null) {
            return redirect()->back()->withErrors('Nu ati selectat niciun fisier.');
        }
        $filename = time() . '.' . str_replace(' ', '', $file->getClientOriginalName());
//        if ($filename == null) {
//            return redirect()->back()->withErrors('Fisier invalid.');
//        }
        $fileType = $request->file('fileToUpload')->getClientOriginalExtension();
        $fileExtension = $request->file('fileToUpload')->guessExtension();

        if ($fileExtension != $fileType){
            return redirect()->back()->withErrors('Fisier invalid, extensia difera de continut.');
        }

        $user_id = Auth::id();

        if ($user_id == null) {
            return redirect('/login')->withErrors('Trebuie sa fiti autentificat pentru a uploada o tema.');
        }

        $homework_id = $request->input('homework-id');

        $homework = Homework::find($homework_id);
        $extensions = $homework->formats;

        $extensionOk = 0;
        foreach ($extensions as $extension) {
            if (str_replace('.', '', $extension->extension_name) == $fileType) {
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

        if ($file->move($path, $filename)) {

            \App\File::create([
                'user_id' => $user_id,
                'homework_id' => $homework_id,
                'file_name' => $filename,
                'grade' => null
            ]);
            return redirect()->back()->withErrors('Fisier uploadat cu succes.');
        } else {
            return redirect()->back()->withErrors('Eroare la upload.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $file = \App\File::where('file_name', $slug)->first();
        $content = mb_convert_encoding(FileSystem::get(public_path() . '/files/' . $file->file_name), 'UTF-16LE', 'UTF-8');
        return view('uploaded-file-details')->with(['file' => $file, 'content' => $content]);
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


    public function download($fileName)
    {
        $path = public_path() . '/files/';
        return response()->download($path . $fileName);
    }
}
