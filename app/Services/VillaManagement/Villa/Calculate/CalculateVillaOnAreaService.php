<?php

namespace App\Services\VillaManagement\Villa\Calculate;

use App\Models\Villas;
use App\Services\BaseService;

class CalculateVillaOnAreaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::whereHas('area')
        ->where('status', 'post')
        ->get();
        $area_id = $dto['area_id'];

        $data = $villas->filter(function($villa) use($area_id) {
            return $villa->area_id == $area_id;
        })->count();

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
