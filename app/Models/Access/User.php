<?php

namespace App\Models\Access;

use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use App\Models\Traits\Render\TableActionsRenderTraite;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities, TableActionsRenderTraite;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $searchableColumns = ['name', 'email'];
  
    protected $adminRouteString = 'admin.users.';

    public function getTableRoleAttribute()
    {
        return implode(',', $this->roles->pluck('title')->toArray());
    }
}
