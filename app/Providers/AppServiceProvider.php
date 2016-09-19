<?php

namespace App\Providers;

use Bouncer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Barryvdh\Debugbar\Middleware\Debugbar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bouncer::cache();

        Blade::directive('allowed', function($action) {
            return '<?php if (Bouncer::allows(' . $action . ')): ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') && env('APP_DEBUG')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            AliasLoader::getInstance()->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
    }
}
