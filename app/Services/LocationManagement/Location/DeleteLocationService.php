<?php

namespace App\Services\LocationManagement\Location;

use App\Models\Location;
use App\Services\BaseService;

class DeleteLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $location = Location::where('id', $dto['location_id'])->first();

        if ($location  == null) {
            return (object) [
                "success" => false,
                "message" => "Location Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $location->delete();
        } else {
            $location->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $location
        ];
    }
}
