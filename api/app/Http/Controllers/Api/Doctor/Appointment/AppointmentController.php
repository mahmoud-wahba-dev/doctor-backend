<?php

namespace App\Http\Controllers\Api\Doctor\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Appointment\StoreAppointmentRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {

    }

    public function store(
        StoreAppointmentRequest $request
    )
    {
        return AppointmentResource::make(
            Appointment::create($request->validated())
        );
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
