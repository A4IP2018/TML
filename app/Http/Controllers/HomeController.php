<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main() {
        if (Auth::check()) {
            return redirect('/homework');
        }
        else {
            return redirect('/login');
        }
    }
}
