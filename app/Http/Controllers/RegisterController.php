<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudentInformation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        return Validator::make($data, [
//            'nr_matricol' => 'required|string|max:255',
//            'username' => 'required|string|max:255',
//            'password' => 'required|string|min:5|confirmed',
//            'role_id' => 'required|string',
//        ]);

    }

    /**
     * View instance
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function index()
    {
        $groups = Group::all();
        return view('register', compact('groups'));
    }

    /**
     * Register user
     *
     * @param Request $request
     * @return mixed
     */
    protected function registerAction(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'unique:users|required|max:255|email',
            'password' => 'required|max:255',
            'first-name' => 'required|max:255',
            'password' => 'required|max:255|confirmed|min:5',
            'confirm-password' => '',
            'first-name' => 'required|max:255',
            'last-name' => 'required|max:255',
            'year' => 'required|integer',
            'group' => 'required',
        ]);
        $password = Hash::make($request->input('password'));

        if (Hash::check($request->input('confirm-password'), $password))
        {

        $user = User::create([
            'email' => $request->input('email'),
            'password' => $password,
            'role_id' => 1,
        ]);

        StudentInformation::create([
            'first_name' => $request->input('first-name'),
            'last_name' => $request->input('last-name'),
            'user_id' => $user->id,
            'year' => (int) $request->input('year'),
            'group_id' => $request->input('group')
        ]);
            return Redirect::to($this->redirectTo);
        }

        return redirect()->back()->withErrors();

    }


}
