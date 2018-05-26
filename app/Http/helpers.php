<?php
/**
 * Created by PhpStorm.
 * User: drozimovschii
 * Date: 13-May-18
 * Time: 9:38 PM
 */

use App\User;
use App\Rank;
use App\Role;
use App\TeacherCourse;
use App\Course;

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




