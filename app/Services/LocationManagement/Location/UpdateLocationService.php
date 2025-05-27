<?php

namespace App\Services\LocationManagement\Location;

use App\Models\Location;
use App\Services\BaseService;

class UpdateLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $location = Location::where('id', $dto['location_id'])->first();

        if ($location  == null)
            throw new \Exception("Location Not Found", 404);

        $location->update([
            "name" => $dto['name'] ?? $location->name,
            "area_id" => $dto['area_id'] ?? $location->area_id,
            "latitude" => $dto['latitude'] ?? $location->latitude,
            "longitude" => $dto['longitude'] ?? $location->longitude,
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
