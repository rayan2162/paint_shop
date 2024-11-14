<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and if 'is_approved' is 1
        if (Auth::check() && Auth::user()->is_approved == 0) {
            Auth::logout();

            return redirect()->route('login')->with('error', 'Your account is not approved yet.');
        }

        return $next($request);
    }
}
