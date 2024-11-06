<?php

namespace App\Http\Controllers\API\LocationManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\LocationManagement\GetLocationResource;
use App\Services\LocationManagement\Location\GetLocationService;
use Illuminate\Http\Request;

class LocationAPIController extends Controller
{
    public function get(
        Request $request,
        GetLocationService $getLocationService,
        $location_id = null,
    ) {
        $location_id = $location_id ?? $request->location_id;

        $request->merge([
            'location_id' => $location_id,
        ]);

        $result = $getLocationService->execute($request->all());

        if(!isset($result->data->id) && isset($location_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetLocationResource($result->data) :
        GetLocationResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Location retrieved successfully',
            'pagination' => $result->pagination ?? null
        ]);
    }
}
