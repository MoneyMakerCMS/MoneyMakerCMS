<?php

use Carbon\Carbon;
use App\Models\Pages\Page;

trait CreatePageTrait
{
    protected function createPage($override = [])
    {
        $repository = app(\App\Repositories\Pages\PagesRepository::class);

        $data = array_merge([
            'name'       => 'Home Page',
            'uri'        => 'test-page',
            'route'      => 'frontend.test-page',
            'type'       => 'database',
            'middleware' => 'web',
            'layout'     => 'frontend.layouts.master',
            'section'    => 'content',
            'content'    => '<h1>@content(\'app-name\')</h1>',
            'file'       => '',
            'active'     => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'title'       => 'Default Homepage Title',
            'description' => 'Default Homepage Description',
            'keywords'    => '',
            'robots'      => 'noindex,nofollow',

        ], $override);

        return $repository->store(null, $data);
    }
}
