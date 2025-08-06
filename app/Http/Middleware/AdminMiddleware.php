<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
   public function handle(Request $request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        abort(403, 'Unauthorized');
    }

    if (!in_array(auth()->user()->role, $roles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
   
   
   
   

   
   
   

   
   
}
