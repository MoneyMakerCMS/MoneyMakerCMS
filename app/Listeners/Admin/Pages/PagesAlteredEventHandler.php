<?php

namespace App\Listeners\Admin\Pages;

use Illuminate\Support\Facades\File;
use App\Repositories\Pages\PagesRepository;
use App\Events\Admin\Pages\PagesAlteredEvent;

class PagesAlteredEventHandler
{
    private $pages;

    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Handle the event.
     *
     * @param  PagesAlteredEvent  $event
     * @return void
     */
    public function handle(PagesAlteredEvent $event)
    {
        $pages = $this->pages->findActive();

        $path = realpath(base_path('routes/Frontend/Dynamic/Dynamic.php'));

        $content = view('pages.routes.routes')->with(['pages' => $pages]);
        
        File::put($path, $content);
    }
}
