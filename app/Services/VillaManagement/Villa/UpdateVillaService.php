<?php

namespace App\Services\VillaManagement\Villa;

use App\Models\Villas;
use App\Services\BaseService;

class UpdateVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $villa = Villas::where('id', $dto['villa_id'])->first();

        if($villa == null)
        throw new \Exception("Villa Not Found", 404);

        $villa->update([
            'villa_id' => $dto['villa_id'] ?? $villa->villa_id,
            'details' => $dto['details'] ?? $villa->details,
            'type' => $dto['type'] ?? $villa->type,
            'start_date' => $dto['start_date'] ?? $villa->start_date,
            'end_date' => $dto['end_date'] ?? $villa->end_date,
            'price' => $dto['price'] ?? $villa->price,
            'total_bedroom' => $dto['total_bedroom'] ?? $villa->total_bedroom,
            'currency' => $dto['currency'] ?? $villa->currency,
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
