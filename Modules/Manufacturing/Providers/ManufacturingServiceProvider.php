<?php

namespace Modules\Manufacturing\Providers;

use App\Utils\ModuleUtil;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ManufacturingServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->registerScheduleCommands();

        //TODO:Remove
        View::composer('manufacturing::layouts.partials.sidebar', function ($view) {
            if (auth()->user()->can('superadmin')) {
                $__is_mfg_enabled = true;
            } else {
                $business_id = session()->get('user.business_id');
                $module_util = new ModuleUtil();
                $__is_mfg_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'manufacturing_module', 'superadmin_package');
            }

            $view->with(compact('__is_mfg_enabled'));
        });
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerCommands();
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('manufacturing.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'manufacturing'
        );
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/manufacturing');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path.'/modules/manufacturing';
        }, config('view.paths')), [$sourcePath]), 'manufacturing');
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/manufacturing');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'manufacturing');
        } else {
            $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'manufacturing');
        }
    }

    /**
     * Register an additional directory of factories.
     */
    public function registerFactories(): void
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__.'/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * Register commands.
     */
    protected function registerCommands(): void
    {

    }

    public function registerScheduleCommands()
    {

    }
}
