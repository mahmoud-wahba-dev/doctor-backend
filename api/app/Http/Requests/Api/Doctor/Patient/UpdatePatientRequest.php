<?php

namespace App\Http\Requests\Api\Doctor\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'gender' => 'required|string',
            'dob' => 'nullable|date',
            'bio' => 'nullable|string',
            'custom_field' => 'nullable|array',
        ];
    }
}
