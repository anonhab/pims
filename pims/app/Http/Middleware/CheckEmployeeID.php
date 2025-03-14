<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeID
{
    public function handle($request, Closure $next)
    {
        // Check if the current request has a named route and it's not 'login'
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Please login to access this page.']);
        }

        return $next($request);
    }
}
