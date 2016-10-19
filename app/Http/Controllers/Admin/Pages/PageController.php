<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Pages\EditPageRequest;
use App\Repositories\Pages\PagesRepository;

class PageController extends Controller
{
    private $pages;

    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;

        $this->authorizeResource($this->pages->getModel());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    public function get()
    {
        return $this->pages->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.form')->with($this->pages->getFormData(null));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $page = $this->pages->store(null, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        return view('admin.pages.form')->with($this->pages->getFormData($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditPageRequest $request, $id)
    {
        $page = $this->pages->store($id, $request->all());

        return redirect()->route('admin.pages.edit', [$page->id])->with('flash', ['type' => 'success', 'message' => 'Page updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pages->delete($id);

        return redirect()->route('admin.pages.index')->with('flash', ['type' => 'success', 'message' => 'Page deleted']);
    }
}
