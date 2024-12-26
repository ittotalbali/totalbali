<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Models\Villas;
use App\Services\BaseService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnAreaService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnLocationService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnSubLocationService;
use App\Services\VillaManagement\Villa\Mapping\WeddingsVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\RetreatsVillaMappingService;

class NearbyVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        $villas = Villas::whereHas('location')
        ->where('id', '!=', $dto['villa_id'])
        ->where('location_id', $dto['location_id'])
        ->where('status', 'post')
        ->orderBy('created_at', 'desc')->limit(12)->get();
        
        $data = $villas->map(function($villa) {
            return [
                'id' => $villa->id,
                'name' => $villa->name,
                'code' => $villa->code,
                'total_bedroom' => $villa->bedroom,
                'total_bathroom' => $villa->bathroom,
                'galeries' => (new GaleriesMappingService)->execute([
                    'galeries' => $villa->galeries
                ])->data[0] ?? null,
                'wedding_villa' => (new WeddingsVillaMappingService)->execute([
                    'wedding' => $villa->wedding
                ])->data,
            'retreats_villa' => (new RetreatsVillaMappingService)->execute([
                'retreats' => $villa->retreats
            ])->data,
            ];
        });

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
