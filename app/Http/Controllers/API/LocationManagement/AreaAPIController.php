<?php

namespace App\Http\Controllers\API\LocationManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\LocationManagement\GetAreaResource;
use App\Services\LocationManagement\Area\GetAreaService;
use Illuminate\Http\Request;

class AreaAPIController extends Controller
{
    public function get(
        Request $request,
        GetAreaService $getAreaService,
        $area_id = null,
    ) {
        $area_id = $area_id ?? $request->area_id;

        $request->merge([
            'area_id' => $area_id,
        ]);

        $result = $getAreaService->execute($request->all());

        if(!isset($result->data->id) && isset($area_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Area not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetAreaResource($result->data) :
        GetAreaResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Area retrieved successfully',
            'pagination' => $result->pagination ?? null
        ]);
    }
}
