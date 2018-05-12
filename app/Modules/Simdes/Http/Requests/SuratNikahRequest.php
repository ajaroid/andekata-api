<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratNikahRequest extends FormRequest
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

            'pemohon_nama' => 'required|string|max:50',
            'pemohon_nik' => 'required|max:16',
            'pemohon_nomor_kk' => 'required|max:16',
            'pemohon_marital_status_id' => 'required|integer',
            'pemohon_status_hub_keluarga_id' => 'required|integer',
            'pemohon_nama_ayah' => 'required|string|max:50',
            'pemohon_nama_ibu' => 'required|string|max:50',
            'pemohon_jenis_kelamin' => 'required|in:M,F',
            'pemohon_tempat_lahir' => 'required|string|max:50',
            'pemohon_tanggal_lahir' => 'required|date',
            'pemohon_golongan_darah' => 'nullable|in:A,B,AB,O',
            'pemohon_religion_id' => 'required|integer',
            'pemohon_education_id' => 'required|integer',
            'pemohon_job_id' => 'required|integer',
            'pemohon_village_id' => 'required|integer',
            'pemohon_alamat' => 'required|string',
            'pemohon_rt' => 'required|max:3',
            'pemohon_rw' => 'required|max:3',
            'pemohon_kewarganegaraan' => 'required|in:WNI,WNA',

            'catin_nama' => 'required|string|max:50',
            'catin_nama_ayah' => 'required|string|max:50',
            'catin_jenis_kelamin' => 'required|in:M,F',
            'catin_tempat_lahir' => 'required|string|max:50',
            'catin_tanggal_lahir' => 'required|date',
            'catin_golongan_darah' => 'nullable|in:A,B,AB,O',
            'catin_religion_id' => 'required|integer',
            'catin_education_id' => 'required|integer',
            'catin_job_id' => 'required|integer',
            'catin_village_id' => 'required|integer',
            'catin_alamat' => 'required|string',
            'catin_rt' => 'required|max:3',
            'catin_rw' => 'required|max:3',
            'catin_kewarganegaraan' => 'required|in:WNI,WNA',

            'ayah_nama' => 'required|string|max:50',
            'ayah_tempat_lahir' => 'required|string|max:50',
            'ayah_tanggal_lahir' => 'required|date',
            'ayah_golongan_darah' => 'nullable|in:A,B,AB,O',
            'ayah_religion_id' => 'required|integer',
            'ayah_education_id' => 'required|integer',
            'ayah_job_id' => 'required|integer',
            'ayah_village_id' => 'required|integer',
            'ayah_alamat' => 'required|string',
            'ayah_rt' => 'required|max:3',
            'ayah_rw' => 'required|max:3',
            'ayah_kewarganegaraan' => 'required|in:WNI,WNA',

            'ibu_nama' => 'required|string|max:50',
            'ibu_tempat_lahir' => 'required|string|max:50',
            'ibu_tanggal_lahir' => 'required|date',
            'ibu_golongan_darah' => 'nullable|in:A,B,AB,O',
            'ibu_religion_id' => 'required|integer',
            'ibu_education_id' => 'required|integer',
            'ibu_job_id' => 'required|integer',
            'ibu_village_id' => 'required|integer',
            'ibu_alamat' => 'required|string',
            'ibu_rt' => 'required|max:3',
            'ibu_rw' => 'required|max:3',
            'ibu_kewarganegaraan' => 'required|in:WNI,WNA',
        ];
    }
}
