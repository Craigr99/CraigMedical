<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // If user does not have a role, return to the 'home' route
        if (!$request->user() || !$request->user()->authorizeRoles($roles)) {
            return redirect()->route('home');
        }
        // Else keep going
        return $next($request);
    }
}
