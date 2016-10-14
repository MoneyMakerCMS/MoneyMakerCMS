<?php

namespace App\Providers;

use App\Repositories\Content\ContentRepository;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ContentRepository::class);


        $this->app['content'] = $this->app->share(function ($app) {
            return new \App\Render\Content\Content(app(ContentRepository::class));
        });

        $loader = AliasLoader::getInstance();

        $loader->alias('Content', \App\Facades\Content\Content::class);

        Blade::directive('content', function ($slug) {
            return "<?php echo Content::render({$slug}); ?>";
        });
    }
}
