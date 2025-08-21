<?php

namespace App\Services\LocationManagement\SubLocation;

use App\Models\SubLocation;
use App\Services\BaseService;

class StoreSubLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $subLocation = SubLocation::create([
            'name' => $dto['name'],
            'location_id' => $dto['location_id'],
        ]);

        return (object) [
            "success" => true,
            "data" => $subLocation
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
