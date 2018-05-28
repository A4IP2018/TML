<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Homework;
use App\File;
use App\Comparison;
use Storage;

class CompareController extends Controller
{
    public function index() {
        if (is_teacher()) {
            return view('compare');
        }
        else {
            Session::flash('error', 'Doar profesorii pot compara teme');
            return redirect()->back();
        }
    }

    public function statsPage(Request $request) {
        $validator = $this->validate($request, [
            'compare-homework' => 'required'
        ]);

        if (is_teacher()) {
            $homework_id = $request->input('compare-homework');
            $current_homework = Homework::where('id', $homework_id)->first();

            if (is_null($current_homework)) {
                Session::flash('error', 'ID gresit');
                return redirect('/');
            }

            $all_files = File::where('homework_id', $homework_id);
            $all_comparisons = Comparison::whereIn('file_id_1', $all_files->pluck('id')->toArray())
                ->orWhereIn('file_id_2', $all_files->pluck('id')->toArray())
                ->get();

            foreach ($all_comparisons as $comparison) {

                $comparison['simm'] = ($comparison->similarityA + $comparison->similarityB) / 2.0;
                $comparison['user_1'] = File::where('id', $comparison->file_id_1)->first()->user;
                $comparison['user_2'] = File::where('id', $comparison->file_id_2)->first()->user;
            }
            $all_comparisons = $all_comparisons->sort(function($item) { return $item['simm']; })->reverse();

            $unique_users = File::all()->unique('user_id');

            return view('compare', compact( 'current_homework', 'all_comparisons', 'unique_users'));
        }

        return redirect()->back()->withErrors($validator);
    }

    public function compareView($id) {
        $comparison = Comparison::where('id', $id)->first();
        if (is_null($comparison)) {
            Session::flash('Asa comparare nu exist&#259;');
            return redirect()->back();
        }

        $file_1 = File::where('id', $comparison->file_id_1)->first();
        $file_2 = File::where('id', $comparison->file_id_2)->first();
        $user_1 = $file_1->user;
        $user_2 = $file_2->user;

        $requirements = $comparison->homework->requirements;
        foreach ($requirements as $requirement) {
            $file_req_1 = File::where('batch_id', $file_1->batch_id)->where('requirement_id', $file_1->requirement_id)->first();
            $file_req_2 = File::where('batch_id', $file_2->batch_id)->where('requirement_id', $file_2->requirement_id)->first();
            $requirement['file_1'] = $file_req_1;
            $requirement['file_2'] = $file_req_2;
            $requirement['file_1_content'] = mb_convert_encoding(Storage::get($file_req_1->storage_path), 'UTF-16LE', 'UTF-8');
            $requirement['file_2_content'] = mb_convert_encoding(Storage::get($file_req_2->storage_path), 'UTF-16LE', 'UTF-8');
        }

        if (is_course_teacher($comparison->homework->course->id) or Auth::id() == $user_1 or Auth::id() == $user_2) {
            return view('compare-homeworks', compact('comparison','file_1', 'file_2', 'user_1', 'user_2', 'requirements'));
        }
        else {
            Session::flash('error', 'Nu ai acces la aceast&#259; comparare');
            return redirect()->back();
        }
    }
}
