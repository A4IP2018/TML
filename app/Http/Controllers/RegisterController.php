<?php

namespace App\Http\Controllers;

use App\Group;
use App\Mail\AccountConfirm;
use App\StudentInformation;
use App\TeacherInformation;
use App\User;
use App\Code;
use Session;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail as Mail;

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
    protected $redirectPath = '/login';

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
    protected function register(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'unique:users|required|max:100|email',
            'first-name' => 'required|max:50',
            'password' => 'required|max:30|min:5|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'required|max:30|min:5',
            'last-name' => 'required|max:50',
        ], [
            'email.required' => 'Campul email este necesar pentru a continua',
            'email.max' => 'Campul email trebuie sa aiba maxim 100 de caractere',
            'email.unique' => 'Acest email este deja folosit',
            'first-name.required' => 'Prenumele este necesar pentru a continua',
            'first-name.max' => 'Prenumele necesita maxim 50 de caractere',
            'last-name.required' => 'Numele este necesar pentru a continua',
            'last-name.max' => 'Numele necesita maxim 50 de caractere',
            'confirm-password.required' => 'Confirmarea parolei este necesara pentru a continua',
            'password.required' => 'Parola este necesara pentru a continua',
            'password.min' => 'Parola necesita minim 5 caractere',
            'password.max' => 'Parola necesita maxim 30 de caractere',
            'password.required_with' => 'Campurile parola si confirmarea parolei trebuie sa fie asemanatoare ',
            'password.same' => 'Campurile parola si confirmarea parolei trebuie sa fie asemanatoare',
        ]);


        $password = Hash::make($request->input('password'));
        $code = $request->input('code');
        $rank = \App\Role::$MEMBER_RANK;
        if (!is_null($code)) {
            $found_code = Code::where('code', $code)->first();
            if (!is_null($found_code)) {
                $rank = $found_code->rank;
                $found_code->delete();
            } else {
                $validator = $this->validate($request, [
                    'student-identifier' => 'required',
                ], [
                    'student-identifier.required' => 'Numarul matricol sau codul unic valid este necesar pentru a continua'
                ]);
            }
        }

        $role_id = \App\Role::where('rank', $rank);
        if (is_null($role_id)) {
            $role_id = \App\Role::where('rank', \App\Role::$MEMBER_RANK);
        }
        else {
            $role_id = $role_id->pluck('id')->first();
        }

        $register_token = generate_random_string(30);
        if (Hash::check($request->input('confirm-password'), $password))
        {
            $is_confirmed = false;
            if (Config::get('values.register_debug') == 'true') {
                $is_confirmed = true;
                $register_token = '';
            }
            else {
                Mail::to($request->input('email'))->send(new AccountConfirm($register_token));
            }


            $user = User::create([
                'email' => $request->input('email'),
                'password' => $password,
                'role_id' => $role_id,
                'reset_token' => '',
                'register_token' => $register_token,
                'is_confirmed' => $is_confirmed
            ]);

            Session::flash('success', 'A fost trimis un mail de confirmare');
          
            if ($rank == \App\Role::$TEACHER_RANK) {
                TeacherInformation::create([
                    'user_id' => $user->id,
                    'name' => $request->input('first-name') . ' ' . $request->input('last-name')
                ]);
            }
            else {
                StudentInformation::create([
                    'first_name' => $request->input('first-name'),
                    'last_name' => $request->input('last-name'),
                    'user_id' => $user->id,
                    'nr_matricol' => $request->input('student-identifier')
                ]);
            }

            return Redirect::to($this->redirectPath);
        }

        return redirect()->back();
    }

    public function confirm($token) {
        $user = \App\User::where('register_token', $token)->first();
        if (is_null($user)) {
            Session::flash('error', 'Adresa de confirmare este invalida');
            return redirect('/register');
        }
        $user->update(['is_confirmed' => true, 'register_token' => '']);
        Session::flash('success', 'Profilul a fost confirmat!');
        return redirect('/login');
    }

}
