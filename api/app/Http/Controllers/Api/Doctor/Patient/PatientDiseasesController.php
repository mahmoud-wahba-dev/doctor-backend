<?php

namespace App\Http\Controllers\Api\Doctor\Patient;

use app\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Patient\StoreDiseasRequest;
use App\Http\Resources\Patient\PatientDiseasesResource;
use App\Models\Context;
use App\Models\Disease;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientDiseasesController extends Controller
{

    public function store(
        Patient $patient,
        StoreDiseasRequest $request
    )
    {
        $patient->diseases()->syncWithoutDetaching([
            $request->disease_id
        ]);

        return PatientDiseasesResource::make(
            $patient->load('diseases')
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
