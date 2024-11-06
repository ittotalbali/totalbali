<?php

namespace App\Services\VillaManagement\Villa;

use App\Models\Villas;
use App\Services\BaseService;

class StoreVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $villa = Villas::create([
            'villa_id' => $dto['villa_id'],
            'details' => $dto['details'],
            'type' => $dto['type'],
            'start_date' => $dto['start_date'],
            'end_date' => $dto['end_date'],
            'price' => $dto['price'],
            'total_bedroom' => $dto['total_bedroom'],
            'currency' => $dto['currency'],
        ]);

        return (object) [
            "success" => true,
            "data" => $villa
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
