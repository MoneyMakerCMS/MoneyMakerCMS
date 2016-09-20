<?php

namespace App\Models\Traits\Render;

trait TableActionsRenderTraite
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route($this->adminRouteString.'edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route($this->adminRouteString.'show', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route($this->adminRouteString.'destroy', $this->id).'"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getUserRolesAttribute()
    {
        return $this->roles->pluck('title')->first();
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return

            // // $this->getLoginAsButtonAttribute() .
            $this->getEditButtonAttribute().
            $this->getShowButtonAttribute().
            $this->getDeleteButtonAttribute();
    }
}
