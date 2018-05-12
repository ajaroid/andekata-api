<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KKDetailRequest extends FormRequest
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
        return [
            'kk_id' => 'required|integer',
            'penduduk_id' => 'required|integer',
            'status_hubungan_keluarga_id' => 'required|integer'
        ];
    }
}
