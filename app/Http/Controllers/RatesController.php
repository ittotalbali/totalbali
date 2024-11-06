<?php

namespace App\Http\Controllers;

use App\Services\VillaManagement\Rate\DeleteRateService;
use App\Services\VillaManagement\Rate\GetRateService;
use App\Services\VillaManagement\Rate\StoreRateService;
use App\Services\VillaManagement\Rate\UpdateRateService;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function get(
        GetRateService $getRateService,
        Request $request
    ) {
        $result = $getRateService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ], 200);
    }

    public function store(
        StoreRateService $storeRateService,
        Request $request
    ) {
        try {
            $result = $storeRateService->execute($request->all());
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $result->data
        ], 200);
    }

    public function update(
        UpdateRateService $updateRateService,
        Request $request
    ) {
        try {
            $result = $updateRateService->execute($request->all());
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $result->data
        ], 200);
    }

    public function delete(
        DeleteRateService $deleteRateService,
        Request $request
    ) {
        try {
            $result = $deleteRateService->execute($request->all());
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rate deleted successfully'
        ], 200);
    }
}
