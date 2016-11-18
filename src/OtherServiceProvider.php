<?php

namespace Liuchengguos\Other;

use Illuminate\Support\ServiceProvider;

class OtherServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->package('liuchengguos/other');
        $this->setupRoutes($this->app->router);
        $this->publishes([
            __DIR__.'/config/other.php' => config_path('other.php'),
        ]);
        $this->loadViewsFrom(__DIR__.'/views', 'courier');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/other.php', 'other'
        );
        config([
            'config/other.php',
        ]);
        $this->app->bind('other', function()
        {
            return new Other;
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Liuchengguos\Other\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
