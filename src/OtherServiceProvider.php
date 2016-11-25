<?php

namespace Liuchengguos\Other;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

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
//        $this->package('liuchengguos/other');

        $this->loadViewsFrom(__DIR__.'/views', 'other');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/config/other.php' => config_path('other.php')
        ], 'other');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/other'),
        ],'other');

        $this->publishes([
            __DIR__.'/migrations/' => database_path('migrations')
        ], 'other');
        $this->setupRoutes($this->app->router);
//        $this->setupRoutes()

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        config([
            'config/other.php',
        ]);
        $this->app->bind('other', function($app)
        {
            return new Other($app);
        });

//        $this->setupClassAliases();
//        $this->registerRouter();
    }

    protected function setupClassAliases()
    {
        $aliases = [
            'admin.router'  => \Liuchengguos\Other\Http\Router::class,
        ];

        foreach ($aliases as $key => $alias) {
            $this->app->alias($key, $alias);
        }
    }
    public function registerRouter()
    {
        $this->app->singleton('admin.router', function ($app) {
            return new Router($app['router']);
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
            require __DIR__.'/http/routes.php';
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array("other");
    }

}
