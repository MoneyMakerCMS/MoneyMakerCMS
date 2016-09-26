<?php

namespace App\Providers;

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
    }
}
