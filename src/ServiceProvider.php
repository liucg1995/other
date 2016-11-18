<?php namespace Liuchengguos\Other;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    public function boot()
    {

    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/http/routes.php';
        }
    }

    public function register()
    {
        $this->registerContact();
        config([
            'config/other.php',
        ]);
    }
    private function registerContact()
    {
        $this->app->bind('other',function($app){
            return new Other($app);
        });
    }
}
