<?php

namespace App\Http\Controllers\Api\Doctor\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Patient\StorePatientRequest;
use App\Http\Requests\Api\Doctor\Patient\UpdatePatientRequest;
use App\Http\Resources\Patient\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PatientResource::collection(
            Patient::paginate(10)
        )->additional([
            'message' => __('Patients retrieved successfully.'),
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param StorePatientRequest $request
     * @return PatientResource
     */
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

    /**
     * @param Patient $patient
     * @return PatientResource
     */
    public function show(
        Patient $patient
    )
    {
        return patientResource::make($patient)->additional([
            'message' => 'Patient retrieved successfully.',
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param UpdatePatientRequest $request
     * @param Patient $patient
     * @return PatientResource
     */
    public function update(
        UpdatePatientRequest $request,
        Patient $patient
    )
    {
        $patient->account()->update($request->validated());
        return PatientResource::make($patient)->additional([
            'message' => 'Patient updated successfully.',
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @param Patient $patient
     * @return JsonResponse
     */
    public function destroy(
        Patient $patient
    )
    {
        $patient->delete();
        return response()->json([
            'message' => 'Patient deleted successfully.',
            'status' => Response::HTTP_OK
        ]);
    }
}
