<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanKKRequest extends FormRequest
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
            'penduduk_id' => 'integer|max:50',
            'nik' => 'required|string|max:16',
            'no_kk_lama' => 'required|string|max:16',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan_id' => 'required|integer',
            'no_telepon' => 'required|string|max:16',
            'kode_pos' => 'required|string|max:5',
            'alasan' => 'required|in:1,2,3',
            'jumlah_anggota_keluarga' => 'required|integer|max:3'
        ];
    }
}
