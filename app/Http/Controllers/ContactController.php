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
            'first-name' => 'required|max:50|min:3',
            'last-name' => 'required|max:50|min:3',
            'email' => 'required|max:100|email|exists:users,email',
            'message' => 'required|max:250|min:3',
        ]);

        Contact::create(['first-name' => $request->input('first-name'),
                    'last-name' => $request->input('last-name'),
                    'email' => $request->input('email'),
                    'message' => $request->input('message')
                ]);

        Session::flash('success', 'Mul&#355;umim pentru c&#259; ne-ai contactat. &#206;&#355;i vom r&#259;spunde &#238;ntr-un timp c&#226;t mai scurt posibil.');

        return redirect()->back();
    }

}