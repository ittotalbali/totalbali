<?php

namespace App\Services\VillaManagement\Villa\Calculate;

use App\Models\Villas;
use App\Services\BaseService;

class CalculateVillaOnLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::whereHas('location')
        ->where('status', 'post')
        ->get();
        $location_id = $dto['location_id'];

        $data = $villas->filter(function($villa) use($location_id) {
            return $villa->location_id == $location_id;
        })->count();

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
