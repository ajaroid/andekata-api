<?php

namespace App\Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

        $rules = 'required|max:255|unique:users';

        $email = 'email|'.$rules;
        $username = 'alpha_dash|'.$rules;

        $email .= $id ? ',email,'.$id.',id' : '';
        $username .= $id ? ',username,'.$id.',id' : '';

        $password = $id ? 'nullable' : 'required';
        $password .= '|min:6';

        return [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'employee_id' => 'nullable|integer',
            'status' => 'integer|min:0|max:2',
        ];
    }
}
