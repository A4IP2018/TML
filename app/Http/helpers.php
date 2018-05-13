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

if (! function_exists('is_teacher'))
{
    function is_teacher($id) {
        return
            User::where('id', $id)
                ->first()
                ->role->rank == Role::$TEACHER_RANK;
    }
}

if (! function_exists('is_homework_author'))
{
    function is_homework_author($homework) {
        if (Auth::check()) {
            return in_array(Auth::id(), $homework->course->users->pluck('id')->toArray());
        }
        return false;
    }
}