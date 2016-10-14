<?php

namespace App\Repositories\Content;

use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;
use Yajra\Datatables\Facades\Datatables;

class ContentRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Content\Content::class)
             ->setRepositoryId(md5('monkeymaker.repository.content'));
    }

    public function get()
    {
        return Datatables::of($this->createModel()->query())
             ->editColumn('enabled', function ($content) {
                 if ($content->enabled) {
                     return "<label class='label label-success'>Active</label>";
                 }

                 return "<label class='label label-warning'>Disabled</label>";
             })
             ->editColumn('type', function ($content) {
                 if ($content->type === 'database') {
                     return "<label class='label label-success'>".$content->type.'</label>';
                 }

                 return "<label class='label label-warning'>".$content->type.'</label>';
             })
             ->editColumn('html', function ($content) {
                 if ($content->html) {
                     return "<label class='label label-default'>HTML/Markup</label>";
                 }

                 return "<label class='label label-default'>Plain Text</label>";
             })->addColumn('actions', function ($content) {
                 return $content->action_buttons;
             })
            ->make(true);
    }

    public function store($id, array $input)
    {
        $data = array_except($input, ['content_id']);

        return !$id ? $this->create($data) : $this->update($id, $data);
    }

    public function render($slug, $locale = 'en')
    {
        if ($content = $this->where('slug', '=', $slug)->where('enabled', '=', 1)->findAll()->first()) {
            return $content->html ? $content->value : strip_tags($content->value);
        }

        return $slug;
    }

    public function toggleStatus($id)
    {
        // Get the content object
        $content = $this->find($id);

        $this->update($id, ['enabled' => !$content->enabled]);

        return $content;
    }
}
