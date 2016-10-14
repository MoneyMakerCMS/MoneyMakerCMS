<?php

namespace App\Render\Content;

use App\Repositories\Content\ContentRepository;

class Content
{
    protected $content;

    public function __construct(ContentRepository $content)
    {
        $this->content = $content;
    }

    public function render($slug)
    {
        return $this->content->render($slug);
    }
}
