<?php


trait CreateUsersWithRolesTrait
{
    protected $user;

    protected function createUserWith($roles = '', $permissions = '')
    {
        $this->user = factory(\App\Models\Access\User::class)->create();

        return tap($this->user, function ($user) use ($roles, $permissions) {
            collect($roles)->each(function ($role) {
                $this->user->assign($role);
            });

            collect($permissions)->each(function ($permission) {
                $this->user->allow($permission);
            });
        });
    }
}
