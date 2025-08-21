<?php

namespace App\Services\VillaManagement\Villa\Calculate;

use App\Models\Villas;
use App\Services\BaseService;

class CalculateVillaOnSubLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::whereHas('sublocation')
        ->where('status', 'post')
        ->get();
        $sub_location_id = $dto['sub_location_id'];

        $data = $villas->filter(function($villa) use($sub_location_id) {
            return $villa->sub_location_id == $sub_location_id;
        })->count();

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
