<?php

namespace App\Http\Requests\Admin\User;

use Bouncer;
use App\Models\Access\User;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::allows('edit', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email,' . $this->get('user_id'),
            'password'              => 'alpha_num|min:6|confirmed',
            'password_confirmation' => 'alpha_num|min:6',
        ];
    }
}
