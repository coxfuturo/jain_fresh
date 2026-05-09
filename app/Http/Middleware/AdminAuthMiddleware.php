<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to admin login route if not authenticated
            return redirect()->route('admin.login');
        }

        // Optionally, check if the authenticated user has an 'admin' role here
        // if (!Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
