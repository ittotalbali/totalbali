<?php

namespace App\Services\LocationManagement\Area;

use App\Models\Areas;
use App\Services\BaseService;

class UpdateAreaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $area = Areas::where('id', $dto['area_id'])->first();

        if ( $area  == null )
        throw new \Exception("Area Not Found", 404);

        $area->update([
            "name" => $dto['name'] ?? $area->name,
            "country_id" => $dto['country_id'] ?? $area->country_id,
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
