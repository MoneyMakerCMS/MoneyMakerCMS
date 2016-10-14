<?php

namespace App\Observers\Admin\Pages;

use App\Events\Admin\Pages\PagesAlteredEvent;
use App\Models\Pages\Page;

class PagesObserver
{
    /**
     * Listen to the Page created event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function saved(Page $page)
    {
        event(new PagesAlteredEvent());
    }

    /**
     * Listen to the Page deleted event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function deleted(Page $page)
    {
        event(new PagesAlteredEvent());
    }
}
