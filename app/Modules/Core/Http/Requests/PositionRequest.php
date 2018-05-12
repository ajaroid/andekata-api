<?php

namespace App\Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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

        $rules = 'required|max:255|unique:positions';

        $name = $rules;
        $code = $rules;
        $dept_id = 'integer';

        $name .= $id ? ',name,'.$id.',id' : '';
        $code .= $id ? ',code,'.$id.',id' : '';

        return [
            'name' => $name,
            'code' => $code,
            'dept_id' => $dept_id
        ];
    }
}
