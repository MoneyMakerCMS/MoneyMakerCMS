<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Admin\User\EditUserRequest;
use App\Http\Requests\Admin\User\CreateUserRequest;

class UsersController extends Controller
{
    protected $users;

    protected $searchableColumns = ['name', 'email'];

    public function __construct(UserRepository $users)
    {
        $this->users = $users;

        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         return view('admin.users.index');
     }

    public function get()
    {
        return $this->users->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->users->getCreateData();
        
        return view('admin.users.form')->with($data);
    }

    /**
     * Store a newly creatted resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->users->store(null, $request);
        
        return redirect()->route('admin.users.edit', [$user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->users->getEditData($id);
        
        return view('admin.users.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $user = $this->users->store($id, $request);

        return redirect()->route('admin.users.edit', [$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->users->delete($id);
        return redirect()->route('admin.users.index');
    }
}
