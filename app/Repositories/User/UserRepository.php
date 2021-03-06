<?php

namespace App\Repositories\User;

use Bouncer;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;
use Yajra\Datatables\Facades\Datatables;

class UserRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Access\User::class)
             ->setRepositoryId(md5('monkeymaker.repository.users'));
    }

    public function get()
    {
        return Datatables::of($this->createModel()->query())
            ->addColumn('roles', function ($u) {
                if ($u->roles->count()) {
                    return implode(',', $u->roles->pluck('title')->toArray());
                }

                return 'none';
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->make(true);
    }

    public function getCreateData()
    {
        return [
            'user'  => $this->createModel(),
            'roles' => Bouncer::role()->all(),
        ];
    }

    public function getEditData($id)
    {
        return [
            'user'  => $this->find($id),
            'roles' => Bouncer::role()->all(),
        ];
    }

    public function store($id, $request)
    {
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if (request()->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($id) {
            $entry = $this->update($id, $data);
        } else {
            $entry = $this->create($data);
        }

        list($status, $user) = $entry;

        if ($request->roles) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        Bouncer::refreshFor($user);

        return $user;
    }
}
