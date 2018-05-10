<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
        return view('register');
    }

    /**
     * Register user
     *
     * @param Request $request
     * @return mixed
     */
    protected function registerAction(Request $request)
    {
        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 1,
        ]);

        return Redirect::to($this->redirectTo);
    }


}
