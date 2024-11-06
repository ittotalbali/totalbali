<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class GaleriesMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $galeries = $dto['galeries'];
        
        if($galeries) {
            $data = $galeries->map(function($item) {
                return [
                    'title' => $item->title,
                    'image_url' => !empty($item->image) ? asset('uploads/'. $item->image) : null,
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
