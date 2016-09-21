<?php

namespace App\Http\Requests\Admin\Content;

use Bouncer;
use App\Models\Content\Content;
use Illuminate\Foundation\Http\FormRequest;

class CreateContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::allows('create', Content::class);
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
            'slug' => 'required|alpha_dash|unique:contents',
            'html' => 'required',
            'type' => 'required|in:database,file',
            'value' => 'required_if:type,database',
            'file' => 'required_if:type,file',
        ];
    }
}
