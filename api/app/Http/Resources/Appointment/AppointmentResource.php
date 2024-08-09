<?php

namespace App\Http\Resources\Appointment;

use App\Http\Resources\Diagnosis\DiagnosisResource;
use App\Http\Resources\Patient\PatientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'time'=> $this->time,
            'price' => $this->price,
            'patient' => PatientResource::make($this->patient),
            'diagnosis' => DiagnosisResource::make($this->diagnosis),
        ];
    }
}
