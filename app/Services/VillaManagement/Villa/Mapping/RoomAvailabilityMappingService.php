<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class RoomAvailabilityMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $calender = $dto['calender'];
        
        if($calender) {
            $data = $calender->map(function($item) {
                return [
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'uuid' => $item->uuid,
                    'summary' => $item->summary,
                    'description' => $item->description,
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
