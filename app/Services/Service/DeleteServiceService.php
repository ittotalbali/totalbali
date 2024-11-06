<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use App\Services\BaseService;

class DeleteServiceService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $service = Service::where('id', $dto['service_id'])->first();

        if ($service  == null) {
            return (object) [
                "success" => false,
                "message" => "Service Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $service->delete();
        } else {
            $service->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $service
        ];
    }
}
