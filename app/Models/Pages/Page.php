<?php

namespace App\Models\Pages;

use App\Models\Seo\Seo;
use App\Models\Traits\Seo\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Render\TableActionsRenderTraite;

class Page extends Model
{
    use SeoTrait, TableActionsRenderTraite;

    protected $guarded = ['id'];
    
    protected $adminRouteString = 'admin.pages.';

     /**
     * Returns the seo entry that belongs to this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'entity');
    }

    public function getMiddleWareAttribute($value)
    {
        return json_decode($value);
    }
    
    public function setMiddleWareAttribute($value)
    {
        $this->attributes['middleware'] = json_encode($value);
    }

    public function getPageMiddleWareAttribute($value)
    {
        return implode(',', collect($this->middleware)->map(function ($m) {
            return '"'.$m. '"';
        })->toArray());
    }
}
