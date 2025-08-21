<?php

namespace App\Services\Facility;

use App\Models\Facilities;
use App\Services\BaseService;

class UpdateFacilityService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $facility = Facilities::where('id', $dto['facility_id'])->first();

        if ( $facility  == null )
        throw new \Exception("Facility Not Found", 404);

        $facility->update([
            "name" => $dto['name'] ?? $facility->name,
            "image" => $dto['image'] ?? $facility->image,
            "description" => $dto['description'] ?? $facility->description,
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
