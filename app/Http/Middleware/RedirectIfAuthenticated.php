<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role->id == 1) {

            return redirect()->route('admin.dashboard');

        } elseif (Auth::guard($guard)->check() && Auth::user()->role->id == 2) {

            return redirect()->route('agent.dashboard');

        } elseif (Auth::guard($guard)->check() && Auth::user()->role->id == 3) {

            return redirect()->route('user.dashboard');

        } 
        else {

            return $next($request);
        }

    }
}
