<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Pages\PagesRepository;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PagesRepository::class);
    }
}
