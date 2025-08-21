<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class BedroomsMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $bedrooms = $dto['bedrooms'];
        
        if($bedrooms) {
            $data = $bedrooms->map(function($item) {
                return [
                    'number_of_bedrooms' => $item->number_of_bedrooms,
                    'type' => $item->type_of_bedroom,
                    'people_can_stay_per_room' => $item->people_can_stay_per_room,
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
