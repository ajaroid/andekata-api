<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanKKDetailRequest extends FormRequest
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
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:16',
            'penduduk_id' => 'integer',
            'permohonan_kk_id' => 'required|integer',
            'status_hub_keluarga_id' => 'required|integer'
        ];
    }
}
