<?php

namespace App\Http\Controllers;
namespace App;
namespace Carbon\Carbon;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Auth;

class UploadController extends Controller
{
    public function uploadForm()
    {
        $today->toDateTimeString();
        $homework_id = Homework::where('slug',$homework_slug)->get();
        $expiredate->Homework::where('deadline',$homework_id)-get();
        if($today<$expiredate)
        {
            return view('deadline-exceeded');
        }
        else
            return view('upload-hw');
    }

    public function uploadSubmit(UploadRequest $request)
    {
        
        
        foreach ($request->homework as $hw) {
            $filename = $hw->store('homework');
            $homework_slug = parse_url($request->url(),PHP_URL_PATH);
            $homework_id = Homework::where('slug',$homework_slug)->get();
            File::create([
                'user_id' => Auth::user()->id,
                'homework_id' => $homework_id,
                'filename' => $filename
            ]);
        }
        return 'Upload successful!';
    }
}
