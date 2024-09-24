<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthCheck
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
        // Check if user is authenticated
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('pages.login')->with('error', 'Your account has been deactivated.');
        }

        // Check if user is active
        if (!Auth::user()->isActive) {
            // Redirect to login page if not active
            return redirect()->route('home')->with('error', 'Your account has been deactivated.');
        }

        
        return $next($request);
    }
}
