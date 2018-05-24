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
            if($user->role_id == Role::$TEACHER_RANK) {
                $userInfo = \App\TeacherInformation::where('user_id', Auth::id())->first();
            }
            else if($user->role_id == Role::$ADMINISTRATOR_RANK){
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
            User::updateOrCreate(['id' => Auth::id()],['password' => $newPassword]);
            return redirect('/profile')->with("success","Parola a fost schimbata cu succes!");;}
        else{
            return redirect('/profile')->withErrors([
                'approve' => 'Parola nu a putut fi schimbata!']);
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
            return redirect('/profile')->with("success","Adresa de mail a fost schimbata cu succes!");
        }
        else{
            return redirect('/profile')->withErrors([
                'approve' => 'Adresa de mail nu a putut fi schimbata!']);
        }
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
            return redirect()->back()->withErrors('approve', 'Nu exista un utilizator cu asa email');
        }

        $token = generate_random_string(30);
        $token_hash = Hash::make($token);
        $user->update(['reset_token' => $token_hash]);
        Mail::to($user->email)->send(new PasswordReset($user->email, $token));

        return redirect()->back()->withErrors([
            'approve' => 'Instruc&#539;iunile au fost trimise']);
    }

    public function newPassword($user_mail, $token) {
        $user = User::where('email', $user_mail)->first();
        if (is_null($user)) {
            return redirect('/forgot')->withErrors('accept', 'Utilizator inexistent');
        }
        if (Hash::check($token, $user->reset_token)) {
            $user->update(['reset_token' => '']);
            return view('reset-password')->with(['email' => $user_mail]);
        }
        else {
            return redirect('/forgot')->withErrors('accept', 'Token gre&#x219;it');
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
        return redirect('/login')->withErrors('accept', 'Parola a fost modificata cu succes');
    }
}
