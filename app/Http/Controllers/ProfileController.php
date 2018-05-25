<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Role;
use App\StudentInformation;
use App\TeacherInformation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as Mail;
use Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            $user = \App\User::where('id', Auth::id())->first();
            if($user->role->rank == Role::$TEACHER_RANK) {
                $userInfo = \App\TeacherInformation::where('user_id', Auth::id())->first();
            }
            else {
                $userInfo = \App\StudentInformation::where('user_id', Auth::id())->first();
            }

            return view('profile', compact('user','userInfo'));
        }
        else {
            return redirect('/login');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword(Request $request)
    {
        $validator = $this->validate($request, [
            'new-password' => 'required|max:255|min:5',
        ]);
        $oldPassword = $request->input('old-password');
        $newPassword = Hash::make($request->input('new-password'));
        $expectedPassword = \App\User::where('id', Auth::id())->value('password');
        if(Hash::check($oldPassword,$expectedPassword)) {
            User::updateOrCreate(['id' => Auth::id()], ['password' => $newPassword]);
            Session::flash('success', 'Parola a fost schimbata cu succes!');
            return redirect('/profile');
        }
        else {
            Session::flash('error', 'Parola nu a putut fi schimbata!');
            return redirect('/profile');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeEmail(Request $request)
    {
        $validator = $this->validate($request, [
            'new-email' => 'required|max:255|email',
        ]);
        $oldEmail = $request->input('old-email');
        $newEmail = $request->input('new-email');
        $expectedEmail = \App\User::where('id', Auth::id())->value('email');
        if($oldEmail==$expectedEmail) {
            User::updateOrCreate(['id' => Auth::id()],['email' => $newEmail]);
            Session::flash('success', 'Adresa de mail a fost schimbata cu succes!');
            return redirect('/profile');
        }
        else{
            Session::flash('error', 'Adresa de mail nu a putut fi schimbata!');
            return redirect('/profile');
        }
    }

    public function changeNrMatricol(Request $request)
    {
        $validator = $this->validate($request, [
            'nr-matricol' => 'required|min:5|max:40',
        ]);

        $new_nr_matricol = $request->input('nr-matricol');
        $user = \App\User::where('id', Auth::id())->first();
        if ($user->role->rank != \App\Role::$MEMBER_RANK) {
            Session::flash('error', 'Doar studentii pot avea numar matricol');
            return redirect('/profile');
        }

        $user->student_information->update(['nr_matricol' => $new_nr_matricol]);

        Session::flash('success', 'Numarul matricol a fost schimbat cu succes!');
        return redirect('/profile')->with(['user' => $user->student_information]);
    }

    public function forgot() {
        return view('forgot-password');
    }

    public function sendToken(Request $request) {
        $validator = $this->validate($request, [
            'user-email' => 'required|max:255|email',
        ]);

        $user_email = $request->input('user-email');
        $user = \App\User::where('email', $user_email)->first();

        if (is_null($user)) {
            Session::flash('error', 'Nu exista un utilizator cu asa email');
            return redirect()->back();
        }

        $token = generate_random_string(30);
        $token_hash = Hash::make($token);
        $user->update(['reset_token' => $token_hash]);
        Mail::to($user->email)->send(new PasswordReset($user->email, $token));

        Session::flash('success', 'Instruc&#539;iunile au fost trimise');
        return redirect()->back();
    }

    public function newPassword($user_mail, $token) {
        $user = User::where('email', $user_mail)->first();
        if (is_null($user)) {
            Session::flash('error', 'Utilizator inexistent');
            return redirect('/forgot');
        }
        if (Hash::check($token, $user->reset_token)) {
            $user->update(['reset_token' => '']);
            Session::flash('success', 'Token valid, puteti schimba parola');
            return view('reset-password')->with(['email' => $user_mail]);
        }
        else {
            Session::flash('error', 'Token gre&#x219;it');
            return redirect('/forgot');
        }
    }

    public function setNewPassword(Request $request) {
        $validator = $this->validate($request, [
            'new-password' => 'required|max:255|min:5|required_with:new-password-repeat|same:new-password-repeat',
            'new-password-repeat' => 'required|max:255|min:5'
        ]);

        $new_password = $request->input('new-password');
        $hash = Hash::make($new_password);
        User::where('email', $request->input('_email'))->first()->update(['password', $hash]);
        Session::flash('success', 'Parola a fost modificata cu succes');
        return redirect('/login');
    }
}
