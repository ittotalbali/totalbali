<?php

namespace App\Services\LocationManagement\SubLocation;

use App\Models\SubLocation;
use App\Services\BaseService;

class DeleteSubLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $subLocation = SubLocation::where('id', $dto['sub_location_id'])->first();

        if ($subLocation  == null) {
            return (object) [
                "success" => false,
                "message" => "Sub Location Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $subLocation->delete();
        } else {
            $subLocation->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $subLocation
        ];
    }
}
