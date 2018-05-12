<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratPelayananRequest extends FormRequest
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
            'village_id' => 'required|integer',
            'keperluan_surat_id' => 'required|integer',
            'job_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'nama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'alamat' => 'required|string|max:30',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'no_kk' => 'required|max:16',
            'nik' => 'required|max:16',
            'tgl_berlaku_dari' => 'required:date',
            'tgl_berlaku_sampai' => 'required:date',
            'keterangan' => 'nullable|string|max:100'
        ];
    }
}
