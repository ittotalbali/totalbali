<?php

namespace App\Services\VillaManagement\Rate;

use App\Models\Rates;
use App\Services\BaseService;

class StoreRateService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $rate = Rates::create([
            'villa_id' => $dto['villa_id'],
            'details' => $dto['details'],
            'type' => $dto['type'],
            'start_date' => $dto['start_date'],
            'end_date' => $dto['end_date'],
            // 'price' => $dto['price'],
            // 'total_bedroom' => $dto['total_bedroom'],
            // 'currency' => $dto['currency'],
            'rooms' => $dto['rooms'],
        ]);

        return (object) [
            "success" => true,
            "data" => $rate
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
