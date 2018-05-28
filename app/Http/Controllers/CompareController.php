<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Homework;
use App\File;
use App\Comparison;
use Storage;
use App\CompareFeedback;
use Session;
use App\Course;

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
            $all_comparisons = $all_comparisons->sortBy('created_at')->reverse();

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

        if (is_course_teacher($comparison->homework->course->id) or Auth::id() == $user_1->id or Auth::id() == $user_2->id) {
            $requirements = $comparison->homework->requirements;
            foreach ($requirements as $requirement) {
                $file_req_1 = File::where('batch_id', $file_1->batch_id)->where('requirement_id', $requirement->id)->first();
                $file_req_2 = File::where('batch_id', $file_2->batch_id)->where('requirement_id', $requirement->id)->first();
                $requirement['file_1'] = $file_req_1;
                $requirement['file_2'] = $file_req_2;
                $requirement['file_1_content'] = Storage::get($file_req_1->storage_path);
                $requirement['file_2_content'] = Storage::get($file_req_2->storage_path);
            }

            $comments = CompareFeedback::where('comparison_id', $comparison->id)->orderBy('created_at', 'DESC')->get();

            return view('compare-homeworks', compact('comparison','file_1', 'file_2', 'user_1', 'user_2', 'requirements', 'comments'));
        }
        else {
            Session::flash('error', 'Nu ai acces la aceast&#259; comparare');
            return redirect()->back();
        }
    }

    public function registerFeedback(Request $request) {
        $validator = $this->validate($request, [
            '_id' => 'required',
            'feedback-text' => 'required'
        ]);

        $text = $request->input('feedback-text');
        $compare = Comparison::where('id', $request->input('_id'))->first();
        if (is_null($compare)) {
            Session::flash('error', 'Aceast&#259; comparare nu exist&#259;');
            return redirect()->back();
        }

        CompareFeedback::create([
            'comparison_id' => $compare->id,
            'comment' => $text,
            'user_id' => Auth::id()
        ]);

        $user_ids = [$compare->file_1->user_id, $compare->file_2->user_id];
        $user_ids = array_merge($user_ids, $compare->homework->course->users->pluck('id')->toArray());

        Session::flash('success', 'Comentariu ad&#259;ugat');

        send_notification(
            $user_ids,
            'Un r&#259;spuns a fost ad&#259;ugat la <a href="' . url('/compare/' . $compare->id) . '">o comparare</a> la tema <a href="'.
            url('/homework/' . $compare->homework->slug) . '">'. $compare->homework->name .'</a>'
        );
        
        return redirect()->back()->withErrors($validator);
    }

    public function encapsulateDivs($content) {
        return $content;
        $lines = $array = preg_split ('/$\R?^/m', $content);
        for ($i = 0; $i < count($lines); $i++) {
            $lines[$i] = mb_convert_encoding('<div>' . $lines[$i] . '</div>', 'UTF-16LE', 'UTF-8');
        }
        return implode('', $lines);
    }

    public function deleteCompare($id) {
        Comparison::where('id', $id)->delete();
        Session::flash('success', 'Comparare &#x219;tears&#259;');
        return redirect()->back();
    }
}
