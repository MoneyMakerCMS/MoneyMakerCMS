<?php

namespace App\Repositories\Pages;

use App\Models\Seo\Seo;
use App\Repositories\Pages\Traits\ParsePageTrait;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Rinvex\Repository\Repositories\EloquentRepository;
use Yajra\Datatables\Facades\Datatables;

class PagesRepository extends EloquentRepository
{
    use ParsePageTrait;

    private $blade;

    private $manager;

    public function __construct(Container $container, Filesystem $manager)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Pages\Page::class)
             ->setRepositoryId(md5('monkeymaker.repository.pages'));

        $this->blade = $container['blade.compiler'];
        $this->manager = $manager;
    }

    public function get()
    {
        return Datatables::of($this->createModel()->query())
             ->editColumn('uri', function ($page) {
                 return "<label class='label label-default'>".url($page->uri).'</label>';
             })->editColumn('active', function ($page) {
                 if ($page->active) {
                     return "<label class='label label-success'>Active</label>";
                 }

                 return "<label class='label label-warning'>Disabled</label>";
             })
             ->editColumn('type', function ($page) {
                 if ($page->type === 'database') {
                     return "<label class='label label-success'>".$page->type.'</label>';
                 }

                 return "<label class='label label-warning'>".$page->type.'</label>';
             })
             ->addColumn('actions', function ($page) {
                 return $page->action_buttons;
             })
            ->make(true);
    }

    public function store($id, array $input)
    {
        $data = array_except($input, ['page_id', 'title', 'description', 'keywords', 'robots', 'image', 'files']);
        
        $return = !$id ? $this->create($data) : $this->update($id, $data);

        list($status, $page) = $return;

        $page->storeSeo($input);

        return $page;
    }

    public function getFormData($id)
    {
        $page = !$id ? $this->createModel() : $this->find($id);

        $seo = !$id ? new Seo() : $page->seo;

        $layouts = $this->manager->allFiles(app('dynamic_layouts_path'));

        $pages = $this->manager->allFiles(app('dynamic_pages_path'));

        $middleware = config('pages.middleware');

        return compact('page', 'seo', 'pages', 'layouts', 'middleware');
    }

    public function render($uri)
    {
        if ($page = $this->where('uri', '=', $uri)->where('active', '=', 1)->findAll()->first()) {
            $content = $page->type === 'database' ? $this->parse($page->content) : $this->getFilePage($page->file);
            
            return collect(['content' => $content, 'page' => $page]);
        }

        return false;
    }

    public function findActive()
    {
        return $this->findWhere(['active', '=', 1])
            ->filter(function ($page, $key) {
                return $page->ab == false;
            });
    }
}
