<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnAreaService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnLocationService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnRateTotalBedroomService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnSubLocationService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnTypeAccommodationService;

class VillaCountMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;

        $rooms = $dto['rates']->map(function($item) {
            $total_bedroom = collect($item->rooms)->map(function($room) {
                return $room['total_bedroom'];
            });

            return $total_bedroom;
        })->flatten()->unique();

        if($dto) {
            $data = [
                'area' => (new CalculateVillaOnAreaService)->execute($dto)->data,
                'location' => (new CalculateVillaOnLocationService)->execute($dto)->data,
                'sub_location' => (new CalculateVillaOnSubLocationService)->execute($dto)->data,
                'type_of_accommodation' => (new CalculateVillaOnTypeAccommodationService)->execute($dto)->data,
                'bedrooms' => $rooms->map(function($room) use($dto) {
                    $dto['total_bedroom'] = $room;

                    return [
                        'total_bedroom' => $room,
                        'villa_count' => (new CalculateVillaOnRateTotalBedroomService)->execute($dto)->data,
                    ];
                })->all(),
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
