<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use App\Services\BaseService;

class StoreServiceService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $service = Service::create([
            'name' => $dto['name'],
            'image' => $dto['image'] ?? null,
            'description' => $dto['description'] ?? null,
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
