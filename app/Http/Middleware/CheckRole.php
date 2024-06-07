<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        Log::info('Role Middleware invoked.');

        if (!Auth::check()) {
            Log::info('User is not authenticated.');
            return redirect('login');
        }

        $user = Auth::user();

        // Check if the user's role is SuperAdministrator or salesManager
        if (!in_array($user->role, [Role::SuperAdministrator, Role::salesManager])) {
            Log::info('User does not have required role.');
            return redirect('home');
        }

        // If the user is a sales manager, redirect them or return a forbidden response
        if ($user->role === Role::salesManager && in_array('user', $roles)) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }
        

        return $next($request);
    }
}
