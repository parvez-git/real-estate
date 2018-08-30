<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{

    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role->id == 2)
        {
            return $next($request);

        }else{

            return redirect()->route('login');
        }
    }
}
