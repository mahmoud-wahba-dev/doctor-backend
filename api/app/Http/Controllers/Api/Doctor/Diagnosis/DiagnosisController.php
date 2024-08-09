<?php

namespace App\Http\Controllers\Api\Doctor\Diagnosis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Diagnosis\StoreDiagnosisRequest;
use App\Http\Requests\Api\Doctor\Diagnosis\UpdateDiagnosisRequest;
use App\Http\Resources\Diagnosis\DiagnosisResource;
use App\Models\Diagnosis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DiagnosisController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DiagnosisResource::collection(Diagnosis::all());
    }

    /**
     * @param StoreDiagnosisRequest $request
     * @return DiagnosisResource
     */
    public function store(
        StoreDiagnosisRequest $request
    )
    {
        return DiagnosisResource::make(
            Diagnosis::create($request->validated())
        );
    }

    /**
     * @param Diagnosis $diagnosis
     * @return DiagnosisResource
     */
    public function show(
        Diagnosis $diagnosis
    )
    {
        return DiagnosisResource::make(
            $diagnosis
        );
    }

    /**
     * @param Diagnosis $diagnosis
     * @param UpdateDiagnosisRequest $request
     * @return DiagnosisResource
     */
    public function update(
        Diagnosis $diagnosis,
        UpdateDiagnosisRequest $request
    )
    {
        $diagnosis->update($request->validated());
        return DiagnosisResource::make(
            $diagnosis
        );
    }

    /**
     * @param Diagnosis $diagnosis
     * @return JsonResponse
     */
    public function destroy(
        Diagnosis $diagnosis
    )
    {
        $diagnosis->delete();
        return response()->json([
            'message' => 'Diagnosis deleted successfully.',
            'status' => Response::HTTP_OK
        ]);
    }
}
