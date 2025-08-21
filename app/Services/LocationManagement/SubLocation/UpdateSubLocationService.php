<?php

namespace App\Services\LocationManagement\SubLocation;

use App\Models\SubLocation;
use App\Services\BaseService;

class UpdateSubLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $subLocation = SubLocation::where('id', $dto['sub_location_id'])->first();

        if ( $subLocation  == null )
        throw new \Exception("Sub Location Not Found", 404);

        $subLocation->update([
            "name" => $dto['name'] ?? $subLocation->name,
            "location_id" => $dto['location_id'] ?? $subLocation->location_id,
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
