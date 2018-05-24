<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;

class AdminController extends Controller
{
    public function index() {
        while (Code::where('rank', \App\Role::$TEACHER_RANK)->count() < 10) {
            Code::create([
               'code' => generate_random_string(10),
                'rank' => \App\Role::$TEACHER_RANK
            ]);
        }
        while (Code::where('rank', \App\Role::$ADMINISTRATOR_RANK)->count() < 10) {
            Code::create([
                'code' => generate_random_string(10),
                'rank' => \App\Role::$ADMINISTRATOR_RANK
            ]);
        }

        $teacher_codes = Code::where('rank', \App\Role::$TEACHER_RANK)->get();
        $admin_codes = Code::where('rank', \App\Role::$ADMINISTRATOR_RANK)->get();
        return view('admin')->with(['teacher_codes' => $teacher_codes, 'admin_codes' => $admin_codes]);
    }
}
