<?php

namespace App\Http\Controllers;

use App\File;
use App\Jobs\CompareUpload;
use App\User;
use App\RequiredFormat;
use Storage;
use App\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FileSystem;
use Session;
use Carbon\Carbon;

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

            $files_grouped  = Auth::user()->files->sortByDesc('created_at')->groupBy('batch_id');
            return view('uploaded-files', compact('files_grouped'));
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


    public function uploadSingle($file_data, $homework_id, $requirement_id, $batch_id)
    {
        $filename = $file_data->getClientOriginalName();
        $fileType = $file_data->getClientOriginalExtension();
        $fileExtension = $file_data->guessExtension();

        $user_id = Auth::id();

        $requirement = \App\RequiredFormat::where('id', $requirement_id)->first();
        $required_extension = str_replace('.', '', $requirement->format->extension_name);

        if ($required_extension != $fileType) {
            return ['Extensie neacceptata pentru fisierul ' . $file_data->getClientOriginalName(), []];
        }

        if ($file_data->getClientSize() > 500000) {
            return ['Fisierul este prea mare.', []];
        }

        $path = $file_data->store(config('app.upload_dir'));
        if (!is_null($path) and $path != '') {
            return
            [
                'Fisier ' . $file_data->getClientOriginalName() . ' a fost incarcat cu succes!',
                [
                    'user_id' => $user_id,
                    'homework_id' => $homework_id,
                    'requirement_id' => $requirement_id,
                    'file_name' => $filename,
                    'storage_path' => $storage_path = $path,
                    'batch_id' => $batch_id
                ]
            ];
        }
        return ['Eroare la incarcarea fisierului ' . $file_data->getClientOriginalName(), []];
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
            'toUpload.*.upload_file' => 'required',
            'toUpload.*.requirement_id' => 'required',
            'homework-id' => 'required'
        ]);


        if (!Auth::check()) {
            Session::flash('error', 'Trebuie sa fiti autentificat pentru a uploada o tema.');
            return redirect('/login');
        }

        $homework_id = $request->input('homework-id');
        $homework = Homework::find($homework_id);

        if (!is_course_teacher($homework->course->id) && $homework->deadline < Carbon::now()) {
            Session::flash('error', 'Termenul limit&#259; a fost dep&#259;&#x219;it. Nu se mai pot &#238;nc&#259;rca fi&#x219;iere');
            return redirect()->back();
        }

        if (is_null($homework)) {
            return redirect('/homework');
        }

        $given_requirements = array_column($request->input('toUpload'), 'requirement_id');
        $needed_requirements = $homework->requirements->pluck('id')->toArray();
        if ($given_requirements != $needed_requirements) {
            return redirect('/homework');
        }

        $batch_id = time() . str_random(5);
        $files = $request->file('toUpload');
        $to_upload = [];
        foreach ($files as $id => $file) {
            $req_id = $request->input('toUpload')[$id];
            $result = $this->uploadSingle($file['upload_file'], $homework_id, $req_id, $batch_id);
            if (empty($result[1])) {
                Session::flash('error', $result[0]);
                return redirect()->back();
            }
            array_push($to_upload, $result);
        }

        foreach ($to_upload as $query) {

            File::create([
                'user_id' => $query[1]['user_id'],
                'homework_id' => $query[1]['homework_id'],
                'requirement_id' => $query[1]['requirement_id'],
                'file_name' => $query[1]['file_name'],
                'batch_id' => $query[1]['batch_id'],
                'storage_path' => $query[1]['storage_path']
            ]);
        }

        $this->dispatch(new CompareUpload($batch_id));
        Session::flash('success', 'Fisierele au fost incarcate!');
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
        $file = \App\File::where('storage_path', config('app.upload_dir') . '/' . $slug)->with('grade')->first();
        $content = Storage::get($file->storage_path);

        return view('uploaded-file-details', compact('file', 'content'));
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


    public function download($storage_name)
    {
        $file = File::where('storage_path', config('app.upload_dir') . '/' . $storage_name)->first();
        if (is_null($file)) {
            Session::flash('Fi&#x219;ierul nu exist&#259;');
            return redirect()->back();
        }

        if (Auth::check() and (Auth::id() == $file->user_id or is_course_teacher($file->homework->course->id)))
        {
            return response()->download(storage_path('app' . '/' . $file->storage_path), $file->file_name);
        }

        Session::flash('error', 'Nu ai acces la acest fisier');
        return redirect()->back();

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
