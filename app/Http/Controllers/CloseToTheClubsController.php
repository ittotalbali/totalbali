<?php

namespace App\Http\Controllers;

use App\Models\CloseToTheClubs;
use App\Services\VillaManagement\Club\GetClubService;
use Illuminate\Http\Request;

class CloseToTheClubsController extends Controller
{
    public function get(
        GetClubService $getClubService,
        Request $request
    ) {
        $request->merge([
            'sort_by' => 'id',
            'sort_type' => 'asc'
        ]);

        $clubs = $getClubService->execute($request->all())->data;

        return response()->json([
            'success' => true,
            'data' => $clubs,
            'message' => 'Clubs retrieved successfully'
        ]);
    }
}
