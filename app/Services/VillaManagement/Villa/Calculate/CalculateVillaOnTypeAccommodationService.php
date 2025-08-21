<?php

namespace App\Services\VillaManagement\Villa\Calculate;

use App\Models\Villas;
use App\Services\BaseService;

class CalculateVillaOnTypeAccommodationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::where('status', 'post')
        ->where('area_id', $dto['area_id'])
        ->where('location_id', $dto['location_id'])
        ->where('sub_location_id', $dto['sub_location_id'])
        ->get();
        $type_accommodation = $dto['type_accommodation'];

        $data = $villas->filter(function($villa) use($type_accommodation) {
            return $villa->type_accomodation == $type_accommodation;
        })->count();

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
