<?php

namespace App\Services\LocationManagement\Location;

use App\Models\Location;
use App\Services\BaseService;

class StoreLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $location = Location::create([
            'name' => $dto['name'],
            'area_id' => $dto['area_id'],
            'latitude' => $dto['latitude'],
            'longitude' => $dto['longitude'],
        ]);

        return (object) [
            "success" => true,
            "data" => $location
        ];
    }

    private function prepare($dto)
    {
        return $dto;
    }
}
