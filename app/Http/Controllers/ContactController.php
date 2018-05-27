<?php

namespace App\Http\Controllers;

use App\Contact;
use Session;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail as Mail;

class ContactController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectPath = '/contact';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * View instance
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function index()
    {
        if (Auth::check())
            return view('contact');
        else
            return redirect('/login');
    }

    protected function sendMessage(Request $request)
    {
        $validator = $this->validate($request, [
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'required|max:50|min:3',
            'email' => 'required|max:100|email|exists:users,email',
            'message' => 'required|max:250|min:3',
        ]);

        Contact::create(['first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'message' => $request->input('message')
                ]);

        Session::flash('success', 'Multumim pentru ca ne-ai contactat. Iti vom raspunde intr-un timp cat mai scurt posibil.');

        return redirect()->back();
    }

}