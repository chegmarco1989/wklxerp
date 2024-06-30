<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $administrator_list = config('constants.administrator_usernames');

        if (! empty($request->user()) && in_array(strtolower($request->user()->username), explode(',', strtolower($administrator_list)))) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
