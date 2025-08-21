<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class ServicesMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $services = $dto['services'];
        
        if($services) {
            $data = $services->map(function($item) {
                return [
                    'name' => $item->name,
                    'image_url' => !empty($item->image) ? asset('uploads/'. $item->image) : null,
                    'description' => $item->description,
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
