<?php

namespace App\Facades\Content;

use Illuminate\Support\Facades\Facade;

class Content extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'content';
    }
}
