<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CreateContentRequest;
use App\Http\Requests\Admin\Content\EditContentRequest;
use App\Repositories\Content\ContentRepository;
use Illuminate\Filesystem\Filesystem;

class ContentController extends Controller
{
    protected $content;

    protected $manager;

    public function __construct(ContentRepository $content, Filesystem $manager)
    {
        $this->content = $content;

        $this->manager = $manager;

        $this->authorizeResource($this->content->getModel());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.index');
    }

    public function get()
    {
        return $this->content->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content = $this->content->createModel();

        $files = $this->manager->allFiles(config('content.file_path'));

        return view('admin.content.form')->with(compact('content', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContentRequest $request)
    {
        $store = $this->content->create($request->except(['files', 'content_id', '_token']));

        list($status, $content) = $store;

        return redirect()->route('admin.content.edit', [$content->id]);
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
        $content = $this->content->find($id);

        $files = $this->manager->allFiles(config('content.file_path'));

        return view('admin.content.form')->with(compact('content', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditContentRequest $request, $id)
    {
        $update = $this->content->update($id, $request->except(['files', 'content_id']));

        list($status, $content) = $update;

        return redirect()->route('admin.content.edit', [$content->id]);
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
    }
}
