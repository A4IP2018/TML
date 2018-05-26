<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use Illuminate\Http\Request;
use Session;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::where('user_id', Auth::id())->get();
        return view('notifications', compact('notifications'));
    }

    public function remove() {
        Notification::where('user_id', Auth::id())->delete();
        Session::flash('success', 'Notific&#259;rile au fost &#x219;terse');
        return redirect()->back();
    }

}
