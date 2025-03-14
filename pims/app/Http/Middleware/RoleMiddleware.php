<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Get user role from session
        $userRole = $request->session()->get('role_id');

        // Debugging: Log role access attempt
        Log::info('Role Middleware Check', ['role_id' => $userRole, 'allowed_roles' => $roles]);

        // Ensure role_id is an integer
        $userRole = is_numeric($userRole) ? (int) $userRole : null;

        // Check if user role exists and is allowed
        if (!$userRole || !in_array($userRole, array_map('intval', $roles))) {
            return redirect()->route('login')->withErrors('Unauthorized access.');
        }

        return $next($request);
    }
}

