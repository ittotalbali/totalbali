<?php

namespace App\Services\LocationManagement\Area;

use App\Models\Areas;
use App\Services\BaseService;

class DeleteAreaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $area = Areas::where('id', $dto['area_id'])->first();

        if ($area  == null) {
            return (object) [
                "success" => false,
                "message" => "Area Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $area->delete();
        } else {
            $area->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $area
        ];
    }
}
