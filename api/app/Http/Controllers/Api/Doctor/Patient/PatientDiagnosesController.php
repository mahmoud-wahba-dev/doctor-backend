<?php

namespace App\Http\Controllers\Api\Doctor\Patient;

use app\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Patient\StoreDiagnosisRequest;
use App\Http\Resources\Patient\PatientDiagnosesResource;
use App\Models\Context;
use App\Models\Disease;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientDiagnosesController extends Controller
{

    public function store(
        Patient $patient,
        StoreDiagnosisRequest $request
    )
    {
        $patient->diagnoses()->syncWithoutDetaching([
            $request->diagnosis_id
        ]);

        return PatientDiagnosesResource::make(
            $patient->load('diagnoses')
        );
    }

    public function show(
    )
    {

    }

    public function destroy()
    {

    }


}
