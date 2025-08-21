<?php

namespace App\Services\LocationManagement\Area;

use App\Models\Areas;
use App\Services\BaseService;

class StoreAreaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $area = Areas::create([
            'name' => $dto['name'],
            'country_id' => $dto['country_id'] ?? 1,
        ]);

        return (object) [
            "success" => true,
            "data" => $area
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
