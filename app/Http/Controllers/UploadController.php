<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\RequiredFormat;
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


    public function uploadSingle($file_data, $homework_id, $requirement_id)
    {
        $path = public_path() . '/files/';
        $filename = time() . '.' . str_replace(' ', '', $file_data->getClientOriginalName());
        $fileType = $file_data->getClientOriginalExtension();
        $fileExtension = $file_data->guessExtension();

        if (!Auth::check()) {
            return redirect('/login')->withErrors('Trebuie sa fiti autentificat pentru a uploada o tema.');
        }

        $user_id = Auth::id();

        $requirement = \App\RequiredFormat::where('id', $requirement_id)->first();
        $required_extension = str_replace('.', '', $requirement->format->extension_name);

        if ($required_extension != $fileType) {
            return redirect()->back()->withErrors('Extensie neacceptata.');
        }

        if ($file_data->getClientSize() > 500000) {
            return redirect()->back()->withErrors('Fisierul este prea mare.');
        }

        if ($file_data->move($path, $filename)) {

            \App\File::create([
                'user_id' => $user_id,
                'homework_id' => $homework_id,
                'requirement_id' => $requirement_id,
                'file_name' => $filename
            ]);
            return redirect()->back()->withErrors('Fisiere uploadat cu succes.');
        } else {
            return redirect()->back()->withErrors('Eroare la upload.');
        }

        dd($file, $requirement_id);
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
            'toUpload' => 'required',
            'homework-id' => 'required'
        ]);

        $homework_id = $request->input('homework-id');
        $homework = Homework::find($homework_id);

        if (is_null($homework)) {
            return redirect('/homework');
        }

        $given_requirements = array_column ($request->input('toUpload'), 'requirement_id');
        $needed_requirements = $homework->requirements->pluck('id')->toArray();
        if ($given_requirements != $needed_requirements) {
            return redirect('/homework');
        }

        $file_id = 0;
        $files = $request->file('toUpload');
        foreach ($files as $id => $file) {
            $req_id = $request->input('toUpload')[$id];
            if (!$this->uploadSingle($file['upload_file'], $homework_id, $req_id)) {
                return redirect()->back()->withErrors('Exista o eroare la procesarea unor din fisiere');
            }
        }
        return redirect()->back();
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

    public function getCheckedUploads($slug) {
        if (Auth::check()) {
            $current_user = Auth::id();
            $homework = Homework::where('slug', $slug)->first();
            $homework->count();
            if (!is_null($homework) && is_homework_author($homework)) {
                // TODO more stuff here
            }
            else {
                return redirect('/homework');
            }
        }
        else {
            return redirect('/login');
        }
    }
}
