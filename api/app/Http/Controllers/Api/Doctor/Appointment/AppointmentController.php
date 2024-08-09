<?php

namespace App\Http\Controllers\Api\Doctor\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Appointment\StoreAppointmentRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(
        Request $request
    )
    {

        $appointments = Appointment::when(
            $request->patient_id , function ($query) use ($request) {
                $query->where('patient_id' , $request->patient_id);}
        )->get();

        return AppointmentResource::collection($appointments);
    }

    public function store(
        StoreAppointmentRequest $request
    )
    {
        $appointment = Appointment::create($request->validated());
        return AppointmentResource::make(
            $appointment->load(['patient' , 'diagnosis'])
        );
    }

    public function show(
        Appointment $appointment
    )
    {
        return AppointmentResource::make($appointment);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
