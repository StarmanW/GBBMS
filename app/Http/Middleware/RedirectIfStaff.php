<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfStaff {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'staff') {
        if (Auth::guard($guard)->check()) {
            if (Auth::guard($guard)->user()->staffPos === 1) {
                return redirect('staff/hr/home');
            } elseif (Auth::guard($guard)->user()->staffPos === 0) {
                return redirect('staff/hr/home');
            }
        }

        return $next($request);
    }
}