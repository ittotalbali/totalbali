<?php

namespace App\Services\Facility;

use App\Models\Facilities;
use App\Services\BaseService;

class DeleteFacilityService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $facility = Facilities::where('id', $dto['facility_id'])->first();

        if ($facility  == null) {
            return (object) [
                "success" => false,
                "message" => "Facility Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $facility->delete();
        } else {
            $facility->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $facility
        ];
    }
}
