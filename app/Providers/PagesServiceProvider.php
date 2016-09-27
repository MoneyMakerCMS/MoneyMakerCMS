<?php

namespace App\Providers;

use App\Listeners\Admin\Pages\PagesAlteredEventHandler;
use App\Models\Pages\Page;
use App\Repositories\Pages\PagesRepository;
use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Page::observe(\App\Observers\Admin\Pages\PagesObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PagesRepository::class);

        $this->app->instance('dynamic_routes_path', realpath(base_path('routes/Frontend/Dynamic/Dynamic.php')));

        $this->app->singleton(PagesAlteredEventHandler::class, function ($app) {
            return new PagesAlteredEventHandler($app[PagesRepository::class], $app['dynamic_routes_path']);
        });
    }
}
