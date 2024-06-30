<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\EcomApiSetting;
use Symfony\Component\HttpFoundation\Response;

class EcomApi
{
    /**
     * Handle an incoming request.
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
