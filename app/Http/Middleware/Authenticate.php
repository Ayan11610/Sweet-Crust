<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Check which guard is being used
            if ($request->is('customer/*')) {
                return route('customer.login.show');
            }
            if ($request->is('staff/*')) {
                return route('staff.login.show');
            }
            // Default to customer login
            return route('customer.login.show');
        }
    }
}
