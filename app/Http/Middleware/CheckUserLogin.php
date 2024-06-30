<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (($request->user()->user_type != 'user' || $request->user()->allow_login != 1) && request()->segment(1) != 'home') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
