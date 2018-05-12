<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKeluarMasukRequest extends FormRequest
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
        $rules = 'required|max:20|unique:surat_keluar_masuk';
        $rules .= $id ? ',no,'.$id.',id' : '';
        return [
            'kelurahan_id' => 'required|integer',
            'no' => $rules,
            'isi' => 'required',
            'dari' => 'nullable|string|max:255',
            'kepada' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|max:255',
            'jenis' => 'required|integer|boolean'
        ];
    }
}
