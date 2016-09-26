<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Render\TableActionsRenderTraite;

class Content extends Model
{
    use TableActionsRenderTraite;

    protected $guarded = ['id'];
    
    protected $adminRouteString = 'admin.content.';
}
