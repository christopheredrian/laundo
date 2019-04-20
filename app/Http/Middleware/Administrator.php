<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO: Sean - Fix these to use the new constants on User
        // TODO: Sean - Just check on "admin" USER_ROLE_ADMIN
        // TODO: Sean - remove super admin we do not have that on the new roles
        if (Auth::user()->hasRole("superadmin") || Auth::user()->hasRole("admin"))
        {
            return $next($request);
        } else
        {
            abort(404);
        }
    }
}
