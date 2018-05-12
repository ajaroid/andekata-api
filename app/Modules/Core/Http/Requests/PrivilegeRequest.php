<?php

namespace App\Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivilegeRequest extends FormRequest
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

        $rules = 'required|max:255|unique:privileges';

        $name = 'alpha_dash|'.$rules;
        $label = $rules;
        $menu = $rules;

        $name .= $id ? ',name,'.$id.',id' : '';
        $label .= $id ? ',label,'.$id.',id' : '';
        $menu .= $id ? ',menu,'.$id.',id' : '';

        return [
            'name' => $name,
            'label' => $label,
            'menu' => $menu
        ];
    }
}
