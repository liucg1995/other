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
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/http/routes.php';
        }
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
        $this->app->bind('other', function()
        {
            return new Other;
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
