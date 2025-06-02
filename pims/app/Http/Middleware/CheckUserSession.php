<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserSession
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session();

        // Check for any valid authenticated session key
        $hasValidSession = $session->has('user_id') || $session->has('lawyer_id') || $session->has('visitor_id');

        if (!$hasValidSession) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        return $next($request);
    }
}