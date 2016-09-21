<?php

namespace App\Models\Content;

use App\Models\Traits\Render\TableActionsRenderTraite;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use TableActionsRenderTraite;

    protected $guarded = ['id'];
    protected $adminRouteString = 'admin.content.';
}
