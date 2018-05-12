<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KKRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'kelurahan_id' => 'required|integer',
            'no_kk' => 'required|max:20',
            'alamat' => 'required|max:255',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'kode_pos' => 'required|max:6',
            'status' => 'required|boolean'
        ];
    }
}
