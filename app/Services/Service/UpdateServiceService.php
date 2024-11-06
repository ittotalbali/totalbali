<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use App\Services\BaseService;

class UpdateServiceService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $service = Service::where('id', $dto['service_id'])->first();

        if ( $service  == null )
        throw new \Exception("Service Not Found", 404);

        $service->update([
            "name" => $dto['name'] ?? $service->name,
            "image" => $dto['image'] ?? $service->image,
            "description" => $dto['description'] ?? $service->description,
        ]);

        return (object) [
            "success" => true,
            "data" => $service
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
