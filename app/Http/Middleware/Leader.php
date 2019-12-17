<?php

namespace App\Http\Middleware;

use App\Role;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Leader
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
        $user = User::find(Auth::user()->id)->roles;
        $just_role = array();
        foreach ($user as $role) {
            $just_role = [$role->role];
        }
        if (in_array('leader', $just_role)) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
