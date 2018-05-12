<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KTPRequest extends FormRequest
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
            'penduduk_id' => 'required|integer',
            'kelurahan_id' => 'required|integer',
            'nama' => 'required|string|max:100',
            'no_kk' => 'required|max:20',
            'nik' => 'required|max:16',
            'alamat' => 'required|max:255',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'kode_pos' => 'required|max:6',
            'jenis' => 'required|in:baru,ganti'
        ];
    }
}
