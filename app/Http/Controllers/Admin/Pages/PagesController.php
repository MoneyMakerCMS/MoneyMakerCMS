<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Pages\EditPageRequest;
use App\Repositories\Pages\PagesRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PagesController extends Controller
{
    use ValidatesRequests;

    private $pages;

    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;

        $this->authorizeResource($this->pages->getModel());
    }

    public function index()
    {
        return view('admin.pages.index');
    }

    public function get()
    {
        return $this->pages->get();
    }

    public function create()
    {
        return view('admin.pages.form')->with($this->pages->getFormData(null));
    }

    public function store(CreatePageRequest $request)
    {
        $page = $this->pages->store(null, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page Created']);
    }

    public function edit($id)
    {
        return view('admin.pages.form')->with($this->pages->getFormData($id));
    }

    public function update(EditPageRequest $request, $id)
    {
        $page = $this->pages->store($id, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page updated']);
    }

    public function destroy($id)
    {
        $this->pages->delete($id);

        return redirect()->route('admin.pages.index')->with('flash', ['type' => 'success', 'message' => 'Page deleted']);
    }
}
