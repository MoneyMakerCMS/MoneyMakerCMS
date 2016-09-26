<?php

namespace App\Http\Requests\Admin\Pages;

use Bouncer;
use App\Models\Pages\Page;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;

class EditPageRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::allows('edit', Page::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'uri' => 'required|unique:pages,uri,' . $this->get('page_id'),
            'route' => 'unique:pages,route,' . $this->get('page_id'),
            'layout' => 'required',
            'type' => 'required|in:database,file',
            'content' => 'required_if:type,database',
            'file' => 'required_if:type,file',
        ];
    }
}
