<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeperluanSuratRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'kode_pelayanan' => 'required|string|max:10',
            'kode_surat' => 'required|string|max:10',
            'tipe' => 'required|integer|in:1,2',
        ];
    }
}
