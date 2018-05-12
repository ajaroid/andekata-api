<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VillageIdentityRequest extends FormRequest
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
            'headman_name' => 'required|string|max:100',
            'headman_nip' => 'required|string|max:20',
            'head_subdistrict_name' => 'required|string|max:100',
            'head_subdistrict_nip' => 'required|string|max:20',
            'regent_name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|max:12',
            'website' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'logo' => 'nullable|string'
        ];
    }
}
