<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class FacilitiesMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $facilities = $dto['facilities'];
        
        if($facilities) {
            $data = $facilities->map(function($item) {
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
