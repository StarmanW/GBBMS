<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HRStaff {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check() && Auth::user()->staffPos === 1) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->staffPos == 0) {
            return redirect('/staff/nurse/home');
        } else {
            return redirect('/login');
        }
    }
}
