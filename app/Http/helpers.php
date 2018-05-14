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



