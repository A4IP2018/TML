<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * View instance
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function index()
    {
        return view('login');
    }

    /**
     * Authenticate user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticate(Request $request)
    {
        $validator = $this->validate($request, [
                        'email' => 'required|max:255|email|exists:users,email',
                        'password' => 'required|max:255',
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_confirmed' => true])) {
            return Redirect::to($this->redirectTo);
        }

        Session::flash('error', 'Date incorecte sau utilizatorul necesita confirmare prie email');
        return redirect()->back()->withInput($request->only('email', 'remember'));

    }


    /**
     * Destroy user session
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function logout()
    {
        Auth::logout();

        return Redirect::to($this->redirectTo);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
