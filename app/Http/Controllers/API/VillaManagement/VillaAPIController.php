<?php

namespace App\Http\Controllers\API\VillaManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\VillaManagement\GetVillaDetailsResource;
use App\Http\Resources\API\VillaManagement\GetVillaResource;
use App\Services\VillaManagement\Villa\GetVillaService;
use Illuminate\Http\Request;

class VillaAPIController extends Controller
{
    public function get(
        Request $request,
        GetVillaService $getVillaService
    ) {
        $request->merge([
            'status' => 'post',
        ]);

        $result = $getVillaService->execute($request->all());

        if(!isset($result->data->id) && isset($request->villa_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Villa not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetVillaResource($result->data) :
        GetVillaResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Villa retrieved successfully',
            'pagination' => $result->pagination ?? null
        ]);
    }

    public function details(
        Request $request,
        GetVillaService $getVillaService,
        $villa_id = null,
    ) {
        $villa_id = $villa_id ?? $request->villa_id;

        if(!$villa_id) {
            return response()->json([
                'success' => false,
                'message' => 'Villa ID is required',
            ], 400);
        }

        $request->merge([
            'villa_id' => $villa_id,
        ]);

        $result = $getVillaService->execute($request->all());

        if(!isset($result->data->id) && isset($villa_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Villa not found',
            ], 404);
        }

        $data = isset($result->data->id) ? new GetVillaDetailsResource($result->data) :
        GetVillaDetailsResource::collection($result->data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Villa retrieved successfully',
        ]);
    }
}
