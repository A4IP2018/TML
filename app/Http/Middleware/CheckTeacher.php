<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Auth;

class CheckTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role->rank != Role::$TEACHER_RANK) {
            Session::flash('error', 'Trebuie s&#259; fii profesor pentru a vizita aceast&#259; pagin&#259;');
            return redirect('/');
        }

        return $next($request);
    }
}
