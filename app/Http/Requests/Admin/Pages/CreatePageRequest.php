<?php

namespace App\Http\Requests\Admin\Pages;

use App\Models\Pages\Page;
use Bouncer;
use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::allows('create', Page::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required',
            'uri'     => 'required|unique:pages',
            'route'   => 'unique:pages',
            'layout'  => 'required',
            'type'    => 'required|in:database,file',
            'content' => 'required_if:type,database',
            'file'    => 'required_if:type,file',
        ];
    }
}
