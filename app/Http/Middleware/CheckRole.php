<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role === 'admin' && Auth::user()->role === 1) {
            return $next($request);
        } else if ($role === 'user' && Auth::user()->role === 2) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
