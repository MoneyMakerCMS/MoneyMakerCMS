<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Pages\EditPageRequest;
use App\Repositories\Pages\PagesRepository;

class PagesController extends Controller
{
    protected $pages;

    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {
        $this->authorize('view', $this->pages->getModel());

        return view('admin.pages.index');
    }

    public function get()
    {
        $this->authorize('view', $this->pages->getModel());

        return $this->pages->get();
    }

    public function create()
    {
        $this->authorize('create', $this->pages->getModel());

        return view('admin.pages.form')->with($this->pages->getFormData(null));
    }

    public function store(CreatePageRequest $request)
    {
        $this->authorize('create', $this->pages->getModel());

        $page = $this->pages->store(null, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page Created']);
    }

    public function edit($id)
    {
        $this->authorize('update', $this->pages->find($id));

        return view('admin.pages.form')->with($this->pages->getFormData($id));
    }

    public function update(EditPageRequest $request, $id)
    {
        $this->authorize('update', $this->pages->find($id));

        $page = $this->pages->store($id, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page updated']);
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->pages->find($id));

        $this->pages->delete($id);

        return redirect()->route('admin.pages.index')->with('flash', ['type' => 'success', 'message' => 'Page deleted']);
    }
}
