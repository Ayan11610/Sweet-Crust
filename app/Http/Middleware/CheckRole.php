<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('staff.login.show');
        }

        // Get user's role name
        $userRole = auth()->user()->role->name;

        // Check if user's role is in the allowed roles
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized access. You do not have permission to access this resource ask SIR IKRAM for permission first.');
        }

        return $next($request);
    }
}
