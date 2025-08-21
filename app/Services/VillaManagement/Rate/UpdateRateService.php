<?php

namespace App\Services\VillaManagement\Rate;

use App\Models\Rates;
use App\Services\BaseService;

class UpdateRateService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $rate = Rates::where('id', $dto['rate_id'])->first();

        if ( $rate  == null )
        throw new \Exception("Rate Not Found", 404);

        $rate->update([
            'villa_id' => $dto['villa_id'] ?? $rate->villa_id,
            'details' => $dto['details'] ?? $rate->details,
            'type' => $dto['type'] ?? $rate->type,
            'start_date' => $dto['start_date'] ?? $rate->start_date,
            'end_date' => $dto['end_date'] ?? $rate->end_date,
            // 'price' => $dto['price'] ?? $rate->price,
            // 'total_bedroom' => $dto['total_bedroom'] ?? $rate->total_bedroom,
            // 'currency' => $dto['currency'] ?? $rate->currency,
            'rooms' => $dto['rooms'] ?? $rate->rooms,
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
