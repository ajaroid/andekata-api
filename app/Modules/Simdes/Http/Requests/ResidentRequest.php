<?php

namespace App\Modules\Simdes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
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
        $nik = 'required|max:16|unique:resident';
        $nik .= $id ? ',nik,'.$id.',id' : '';

        return [
            'village_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'marital_status_id' => 'required|integer',
            'status_hub_keluarga_id' => 'required|integer',
            'job_id' => 'required|integer',
            'education_id' => 'required|integer',
            'nik' => $nik,
            'name' => 'required|string|max:50',
            'gender' => 'required|in:M,F',
            'birth_place' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'father_name' => 'nullable|string|max:50',
            'mother_name' => 'nullable|string|max:50',
            'citizenship' => 'required|in:WNI,WNA',
            'passport_number' => 'nullable|max:10',
            'kitas_number' => 'nullable|max:15',
            'status' => 'required|in:active,move,died'
        ];
    }
}
