<?php

namespace App\Http\Controllers\API\VillaManagement;

use App\Helpers\PaginationAdapter;
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

        $compatibleResult =$result;

        if (isset($compatibleResult->pagination)) {
            $data = GetVillaResource::collection($compatibleResult->data);
            
            $response = response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Villa retrieved successfully',
                'pagination' => $result->pagination
            ]);
        } else {
            // Handle single item response
            $data = isset($compatibleResult->data->id) ? 
                   new GetVillaResource($compatibleResult->data) : 
                   GetVillaResource::collection($compatibleResult->data);

            $response = response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Villa retrieved successfully',
            ]);
        }

        $data = $response->getData();
        $dataArray = json_decode(json_encode($data), true);

        $conversion_data = $getVillaService->printArr($request->all(), $dataArray);

        // Return response with proper pagination structure
        if (isset($compatibleResult->pagination)) {
            return response()->json([
                'success' => true,
                'data' => $conversion_data,
                'message' => 'Villa retrieved successfully',
                'pagination' => $compatibleResult->pagination
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => $conversion_data,
                'message' => 'Villa retrieved successfully',
            ]);
        }
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

        $response = response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Villa retrieved successfully',
        ]);
        
        // Get the JSON data as an array or object
        $data = $response->getData(); // This will return the data as an stdClass object
        
        // You can also convert it to an array if you prefer
        // $arrayData = (array) $data; // Convert to an array if needed
        
        $dataArray = json_decode(json_encode($data), true);

        $conversion_data = $getVillaService->print($request->all(), $dataArray);

        return response()->json([
            'success' => true,
            'data' => $conversion_data,
            'message' => 'Villa retrieved successfully',
        ]);
    }
}
