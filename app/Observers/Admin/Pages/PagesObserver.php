<?php

namespace App\Observers\Admin\Pages;

use App\Models\Pages\Page;
use App\Events\Admin\Pages\PagesAlteredEvent;

class PagesObserver
{
    /**
     * Listen to the Page created event.
     *
     * @param  Page  $page
     * @return void
     */
    public function saved(Page $page)
    {
        event(new PagesAlteredEvent());
    }

    /**
     * Listen to the Page deleted event.
     *
     * @param  Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        event(new PagesAlteredEvent());
    }
}
