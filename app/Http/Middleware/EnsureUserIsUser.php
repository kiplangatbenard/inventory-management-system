<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EnsureUserIsUser
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'user' role
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Redirect unauthorized users with an error message
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}