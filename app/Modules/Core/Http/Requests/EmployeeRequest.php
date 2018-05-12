<?php

namespace App\Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required|max:255',
            'birth_date' => 'required|date',
            'birth_city' => 'required',
            'gender' => 'required|in:L,P',
            'marital_status_id' => 'required|integer|min:0|max:99', // NOTE kalau validasi integer, maka max dihitung dari valuenya, misal max:99 berarti maksimal input = 99
            'job_status' => 'required|integer|min:0|max:9',
            'phone_number' => 'nullable|numeric',
            'email' => 'nullable|email',
            'position_id' => 'nullable|integer',
            'village_id' => 'integer',
            'in_date' => 'nullable|date',
            'out_date' => 'nullable|date|after:in_date',
            'status' => 'required|integer|min:0|max:9',
            'photo' => 'nullable|string'
        ];
    }
}
