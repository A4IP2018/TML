<?php

namespace App\Http\Controllers;

use App\Role;
use App\StudentInformation;
use App\TeacherInformation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function resetPassword(Request $request)
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
    public function resetEmail(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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
}
