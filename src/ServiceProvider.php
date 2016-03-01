<?php

namespace gocrew\LaravelReAuth;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'reauth'
        );
    }

    /**
     * Boot service provider.
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'gocrew\LaravelReAuth\Http\Controllers'], function ($router) {
                require __DIR__.'/Http/routes.php';
            });
        }

        $this->loadViewsFrom(
            __DIR__.'/../views', 'gocrew'
        );

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('reauth.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/gocrew'),
        ]);
    }
}
