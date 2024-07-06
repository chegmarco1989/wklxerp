<?php

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \Unicodeveloper\Paystack\PaystackServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,
        \Collective\Html\HtmlServiceProvider::class,
        \Milon\Barcode\BarcodeServiceProvider::class,
        \ConsoleTVs\Charts\ChartsServiceProvider::class,
        \Nwidart\Menus\MenusServiceProvider::class,
        \Knox\Pesapal\PesapalServiceProvider::class,
        \Jenssegers\Agent\AgentServiceProvider::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(AppServiceProvider::HOME);

        $middleware->validateCsrfTokens(except: [
            '/install/details',
            '/install/post-details',
            '/install/install-alternate',
            '/api/ecom/customers',
            '/api/ecom/orders',
            '/webhook/*',
        ]);

        $middleware->throttleApi();

        $middleware->replace(\Illuminate\Foundation\Http\Middleware\TrimStrings::class, \App\Http\Middleware\TrimStrings::class);

        $middleware->alias([
            'AdminSidebarMenu' => \App\Http\Middleware\AdminSidebarMenu::class,
            'CheckUserLogin' => \App\Http\Middleware\CheckUserLogin::class,
            'EcomApi' => \App\Http\Middleware\EcomApi::class,
            'SetSessionData' => \App\Http\Middleware\SetSessionData::class,
            'authh' => \App\Http\Middleware\IsInstalled::class,
            'language' => \App\Http\Middleware\Language::class,
            'setData' => \App\Http\Middleware\IsInstalled::class,
            'superadmin' => \App\Http\Middleware\Superadmin::class,
            'timezone' => \App\Http\Middleware\Timezone::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
