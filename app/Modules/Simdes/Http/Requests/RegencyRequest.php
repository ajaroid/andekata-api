<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegencyRequest extends FormRequest
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
        $code = $id
            ? 'required|unique:regency,code,'.$id.',id'
            : 'required|unique:regency';

        return [
            'name' => 'required',
            'provincy_id' => 'required|integer',
            'code' => $code
        ];
    }
}
