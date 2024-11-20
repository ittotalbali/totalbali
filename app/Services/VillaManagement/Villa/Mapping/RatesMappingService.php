<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;
use App\Services\VillaManagement\Villa\Calculate\CalculateVillaOnRateTotalBedroomService;

class RatesMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        $rates = $dto['rates'];

        if($rates) {
            $data = $rates->map(function($item) {
                return [
                    'id' => $item->id, 
                    'details' => $item->details,
                    'type' => $item->type,
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'rooms' => collect($item->rooms)->map(function($room) use($item) {
                        return [
                            'rates_id' => $item->id,
                            'total_bedroom' => $room['total_bedroom'],
                            'currency' => !empty($room['currency']) ? $room['currency'] : null,
                            'price' => $room['price'],
                            // 'villa_count' => (new CalculateVillaOnRateTotalBedroomService)->execute([
                            //     'total_bedroom' => $room['total_bedroom'],
                            // ])->data,
                        ];
                    }),
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
