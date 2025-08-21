<?php

namespace App\Http\Controllers\API\Facility;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Facility\GetFacilityResource;
use App\Services\Facility\GetFacilityService;
use Illuminate\Http\Request;

class FacilityAPIController extends Controller
{
    public function get(
        Request $request,
        GetFacilityService $getFacilityService,
        $facility_id = null,
    ) {
        $facility_id = $facility_id ?? $request->facility_id;

        $request->merge([
            'facility_id' => $facility_id,
        ]);

        $result = $getFacilityService->execute($request->all());

        if(!isset($result->data->id) && isset($facility_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Facility not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetFacilityResource($result->data) :
        GetFacilityResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Facility retrieved successfully',
            'pagination' => $result->pagination ?? null
        ]);
    }
}
