<?php

namespace App\Listeners\Admin\Pages;

use App\Events\Admin\Pages\PagesAlteredEvent;
use App\Repositories\Pages\PagesRepository;
use Illuminate\Support\Facades\File;

class PagesAlteredEventHandler
{
    private $pages;
    private $routePath;

    public function __construct(PagesRepository $pages, $routePath)
    {
        $this->routePath = $routePath;
        $this->pages = $pages;
    }

    /**
     * Handle the event.
     *
     * @param PagesAlteredEvent $event
     *
     * @return void
     */
    public function handle(PagesAlteredEvent $event)
    {
        $pages = $this->pages->findActive();

        $content = view('pages.routes.routes')->with(['pages' => $pages]);

        File::put($this->routePath, $content);
    }
}
