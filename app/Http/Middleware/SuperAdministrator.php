<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

// TODO: Sean - remove super admin we do not have that on the new roles (for now )
class SuperAdministrator
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
        if (Auth::user()->hasRole("superadmin")){
            return $next($request);
        } else{
            abort(404);
        }
    }
}
