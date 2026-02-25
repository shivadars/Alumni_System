<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // If user has no profile and is not currently on the profile creation/storage route
            // And also ignoring logout/profile routes to avoid infinite loops or blocking exit
            if (!$user->profile && 
                !$request->routeIs('profile.create') && 
                !$request->routeIs('profile.store-details') &&
                !$request->routeIs('logout')) {
                
                return redirect()->route('profile.create');
            }
        }

        return $next($request);
    }
}
