<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Customer
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
        // TODO: Sean - Just check on "customer"
        if (Auth::user()->hasRole("superadmin") ||
            Auth::user()->hasRole("admin") ||
            Auth::user()->hasRole("manager") ||
            Auth::user()->hasRole("customer")){
            return $next($request);
        } else{
            abort(404);
        }
    }
}
