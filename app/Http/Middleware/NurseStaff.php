<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NurseStaff {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check() && Auth::user()->staffPos === 0) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->staffPos == 1) {
            return redirect('/staff/hr/home');
        } else {
            return redirect('/login');
        }
    }
}
