<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use Bouncer;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bouncer::role());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Bouncer::role()->all();

        return view('admin.roles.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Bouncer::role();

        $abilities = Bouncer::ability()->all()->reject(function ($ability) {
            return $ability->title == 'God Mode';
        });

        return view('admin.roles.form')->with(compact('role', 'abilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $role = Bouncer::role()->create([
            'title' => request()->title,
            'name'  => str_slug(request()->title),
        ]);

        if (request()->abilities) {
            $role->abilities()->sync(request()->abilities);
        } else {
            $role->abilities()->detach();
        }

        if (request()->abilities) {
            $role->abilities()->sync(request()->abilities);
        } else {
            $role->≈()->detach();
        }

        Bouncer::refresh();

        return redirect()->route('admin.roles.edit', $role->id);
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
        //
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
        $role = Bouncer::role()->find($id);

        $abilities = Bouncer::ability()->all()->reject(function ($ability) {
            return $ability->title == 'God Mode';
        });

        return view('admin.roles.form')->with(compact('role', 'abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $role = Bouncer::role()->find($id);

        $role->name = str_slug(request()->title);

        $role->title = request()->title;

        $role->save();

        if (request()->abilities) {
            $role->abilities()->sync(request()->abilities);
        } else {
            $role->abilities()->detach();
        }

        Bouncer::refresh();

        return redirect()->route('admin.roles.edit', $role->id);
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
        //
    }
}
