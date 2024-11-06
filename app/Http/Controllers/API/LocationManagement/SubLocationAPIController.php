<?php

namespace App\Http\Controllers\API\LocationManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\LocationManagement\GetSubLocationResource;
use App\Services\LocationManagement\SubLocation\GetSubLocationService;
use Illuminate\Http\Request;

class SubLocationAPIController extends Controller
{
    public function get(
        Request $request,
        GetSubLocationService $getSubLocationService,
        $sub_location_id = null,
    ) {
        $sub_location_id = $sub_location_id ?? $request->sub_location_id;

        $request->merge([
            'sub_location_id' => $sub_location_id,
        ]);

        $result = $getSubLocationService->execute($request->all());

        if(!isset($result->data->id) && isset($sub_location_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Sub location not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetSubLocationResource($result->data) :
        GetSubLocationResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sub location retrieved successfully',
            'pagination' => $result->pagination ?? null
        ]);
    }
}
