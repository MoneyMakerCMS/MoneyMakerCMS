<?php

namespace App\Http\Requests\Admin\Content;

use Bouncer;
use App\Models\Content\Content;
use Illuminate\Foundation\Http\FormRequest;

class EditContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::allows('edit', Content::class);
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
            'html' => 'required',
            'value' => 'required_if:type,database',
            'file' => 'required_if:type,file',
            'type' => 'required|in:database,file',
            'slug' => 'required|alpha_dash|unique:contents,slug,' . $this->get('content_id'),
        ];
    }
}
