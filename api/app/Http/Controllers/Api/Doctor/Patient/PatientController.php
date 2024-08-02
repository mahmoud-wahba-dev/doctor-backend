<?php

namespace App\Http\Controllers\Api\Doctor\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Patient\StorePatientRequest;
use App\Http\Resources\Patient\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function index()
    {

    }

    public function store(
        StorePatientRequest $request
    )
    {
        $patient = Patient::create([
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        $account = $patient->account()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender'  => $request->gender,
            'dob'    => $request->dob,
            'bio'   => $request->bio,
            'custom_field' => $request->custom_field,
        ]);
        return PatientResource::make($patient)->additional([
            'message' => 'Patient created successfully.',
            'status' => Response::HTTP_CREATED
        ]);
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
