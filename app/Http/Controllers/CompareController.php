<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Homework;
use App\File;
use App\Comparison;

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
}
