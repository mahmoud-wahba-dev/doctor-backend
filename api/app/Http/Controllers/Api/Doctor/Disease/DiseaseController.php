<?php

namespace App\Http\Controllers\Api\Doctor\Disease;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Disease\StoreDiseaseRequest;
use App\Http\Requests\Api\Doctor\Disease\UpdateDiseaseRequest;
use App\Http\Resources\Disease\DiseaseResource;
use App\Models\Disease;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DiseaseController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DiseaseResource::collection(Disease::all());
    }

    /**
     * @param StoreDiseaseRequest $request
     * @return DiseaseResource
     */
    public function store(
        StoreDiseaseRequest $request
    )
    {
        return DiseaseResource::make(
            Disease::create($request->validated())
        );
    }

    /**
     * @param Disease $disease
     * @return DiseaseResource
     */
    public function show(
        Disease $disease
    )
    {
        return DiseaseResource::make(
            $disease
        );
    }

    /**
     * @param Disease $disease
     * @param UpdateDiseaseRequest $request
     * @return DiseaseResource
     */
    public function update(
        Disease $disease,
        UpdateDiseaseRequest $request
    )
    {
        return DiseaseResource::make(
            $disease->update($request->validated())
        );
    }

    /**
     * @param Disease $disease
     * @return JsonResponse
     */
    public function destroy(
        Disease $disease
    )
    {
        $disease->delete();
        return response()->json([
            'message' => 'Disease deleted successfully.',
            'status' => Response::HTTP_OK
        ]);
    }
}
