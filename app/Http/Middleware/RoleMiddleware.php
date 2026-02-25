<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if user has one of the allowed roles
        // We use ...$roles to allow passing multiple roles like 'admin,student'
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // If user is authenticated but doesn't have the right role
        // Redirect to their specific dashboard or a generic unauthorized page
        if ($user->role === 'admin') {
             return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
             return redirect()->route('student.dashboard');
        } elseif ($user->role === 'alumni') {
             return redirect()->route('alumni.dashboard');
        }

        abort(403, 'Unauthorized access.');
    }
}
