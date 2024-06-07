<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string[]  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Redirect to login if user is not authenticated
            return redirect('/login');
        }

        $user = Auth::user();
        $userRole = $user->role; // Assuming `role` is stored as an integer in the database

        // Check if user's role is in the allowed roles
        if (!in_array($userRole, array_map(fn($role) => constant("App\\Enums\\Role::$role")->value, $roles))) {
            // Redirect to unauthorized page if user does not have the right role
            return redirect('/unauthorized');
        }

        return $next($request);
    }
}


