<?php

namespace App\Http\Requests\Api\Doctor\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'patient_id' => 'required|exists:users,id',
            'disease_id' => 'required|exists:diseases,id',
            'price' => 'required|numeric|min:0',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
        ];
    }
}
