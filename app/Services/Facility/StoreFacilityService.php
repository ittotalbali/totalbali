<?php

namespace App\Services\Facility;

use App\Models\Facilities;
use App\Services\BaseService;

class StoreFacilityService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $facility = Facilities::create([
            'name' => $dto['name'],
            'image' => $dto['image'] ?? null,
            'description' => $dto['description'] ?? null,
        ]);

        return (object) [
            "success" => true,
            "data" => $facility
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
