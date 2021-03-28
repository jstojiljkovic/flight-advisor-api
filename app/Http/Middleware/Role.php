<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        abort_unless(auth()->user()->hasRole($role), 403, 'You dont have correct permission to access this.');
        
        return $next($request);
    }
}
