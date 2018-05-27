<?php
/**
 * Created by PhpStorm.
 * User: drozimovschii
 * Date: 13-May-18
 * Time: 9:38 PM
 */

use App\Grade;
use App\User;
use App\Rank;
use App\Role;
use App\TeacherCourse;
use App\Course;
use Carbon\Carbon;
use App\Notification;
use App\Http\Controllers\NotificationController as Notifications;
use Illuminate\Support\Facades\Auth;

Carbon::setLocale('ro');

if (! function_exists('is_teacher')) {
    function is_teacher() {
        if (Auth::check()) {
            return User::where('id', Auth::id())
                    ->first()
                    ->role->rank == Role::$TEACHER_RANK;
        }
        return false;
    }
}


if (! function_exists('is_teacher_id')) {
    function is_teacher_id($id) {
        if (Auth::check()) {
            return User::where('id', $id)
                    ->first()
                    ->role->rank == Role::$TEACHER_RANK;
        }
        return false;
    }
}


if (! function_exists('get_teacher_names')) {
    function get_teacher_names($course)
    {
        $teachers_string = null;
        if (!is_null($course->users)) {
            $teachers_string = implode(", ", $course->users
                ->map(function ($user) {
                    if (!is_null($user->teacher_information)) {
                        return $user->teacher_information->name;
                    }
                    return null;
                })
                ->filter(function ($str) {
                    return is_null($str) ? false : true;
                })
                ->toArray());

        }
        if (is_null($teachers_string)) {
            $teachers_string = 'Nici un profesor specificat';
        }
        return $teachers_string;
    }
}

if (! function_exists('is_student')) {
    function is_student() {
        if (Auth::check()) {
            return User::where('id', Auth::id())
                    ->first()
                    ->role->rank == Role::$MEMBER_RANK;
        }
        return false;
    }
}

if (! function_exists('isAlreadyMarked')) {
    function isAlreadyMarked($homework) {
        $check = false;
        if (Auth::check()) {
            $userGrades = Grade::where('user_id', Auth::id())->with('file.homework')->get();
            foreach($userGrades as $userGrade) {
                if ($userGrade->file && $userGrade->file->homework->id === $homework->id) {
                    $check = true;
                }
            }
        }
        return $check;
    }
}


if (! function_exists('is_administrator')) {
    function is_administrator() {
        if (Auth::check()) {
            return User::where('id', Auth::id())
                    ->first()
                    ->role->rank == Role::$ADMINISTRATOR_RANK;
        }
        return false;
    }
}

if (! function_exists('is_course_teacher')) {
    function is_course_teacher($course_id) {
        if (Auth::check()) {
            return TeacherCourse::where('user_id', Auth::id())
                    ->where('course_id', $course_id)
                    ->count() != 0;
        }
        return false;
    }
}

if (! function_exists('is_course_teacher_id')) {
    function is_course_teacher_id($course_id, $user_id) {
        if (Auth::check()) {
            return TeacherCourse::where('user_id', $user_id)
                    ->where('course_id', $course_id)
                    ->count() != 0;
        }
        return false;
    }
}

if (! function_exists('is_homework_author')) {
    function is_homework_author($homework) {
        if (Auth::check()) {
            return in_array(Auth::id(), $homework->course->users->pluck('id')->toArray());
        }

        return false;
    }
}

if (! function_exists('is_subscribed_to_course')) {
    function is_subscribed_to_course($course_id) {
        if (Auth::check()) {
            return Course::where('id', $course_id)
                    ->first()
                    ->subscriptions
                    ->where('id', Auth::id())
                    ->count() != 0;
        }
        return false;
    }
}

if (! function_exists('can_subscribe')) {
    function can_subscribe($course_id) {
        return !is_course_teacher($course_id) and !is_subscribed_to_course($course_id);
    }
}

if (! function_exists('plagiarism_check')) {
    function plagiarism_check($sx, $sy, $prec = 0, $MAXLEN = 90000)
    {
        $x = $min = strlen(gzcompress($sx));
        $y = $max = strlen(gzcompress($sy));
        $xy = strlen(gzcompress($sx . $sy));
        $a = $sx;
        if ($x > $y) {
            $min = $y;
            $max = $x;
            $a = $sy;
        }
        $res = ($xy - $min) / $max;


        if ($MAXLEN < 0 || $xy < $MAXLEN) {
            $aa = strlen(gzcompress($a . $a));
            $ref = ($aa - $min) / $min;
            $res = $res - $ref;
        }
        return ($prec < 0) ? $res : 100 - ( 100 * round($res, 2 + $prec));
    }
}

if (! function_exists('generate_random_string')) {
    function generate_random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (! function_exists('get_role')) {
    function get_role() {
        if (Auth::check()) {
            $rank = User::where('id', Auth::id())->first()->role->rank;
            if ($rank == \App\Role::$TEACHER_RANK) {
                return 'Profesor';
            }
            else if ($rank == \App\Role::$ADMINISTRATOR_RANK) {
                return 'Administrator';
            }
            else if ($rank == \App\Role::$MEMBER_RANK) {
                return 'Membru';
            }
        }
    }
}

if (! function_exists('send_notification'))
{
    function send_notification($user_ids, $message) {
        foreach ($user_ids as $user_id) {
            Notification::create([
                'user_id' => $user_id,
                'message' => $message,
                'seen' => false
            ]);
        }
    }
}


if (! function_exists('get_name'))
{
    function get_name() {
        if (Auth::check())
        {
            if (is_teacher()) {
                return Auth::user()->teacher_information->name;
            }
            else {
                return Auth::user()->student_information->first_name . ' ' . Auth::user()->student_information->last_name;
            }
        }
        return '';
    }
}


if (! function_exists('get_name_by_id'))
{
    function get_name_by_id($id) {
        if (Auth::check())
        {
            if (is_teacher_id($id)) {
                return User::where('id', $id)->first()->teacher_information->name;
            }
            else {
                return User::where('id', $id)->first()->student_information->first_name . ' ' . User::where('id', $id)->first()->student_information->last_name;
            }
        }
        return '';
    }
}


