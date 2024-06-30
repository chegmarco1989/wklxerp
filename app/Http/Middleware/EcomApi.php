<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;
use Modules\Ecommerce\Entities\EcomApiSetting;

class EcomApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('API-TOKEN');
        $is_api_settings_exists = EcomApiSetting::where('api_token', $token)
                                            // ->where('shop_domain', $shop_domain)
            ->exists();

        if (! $is_api_settings_exists) {
            exit('Invalid Request');
        }

        return $next($request);
    }
}
