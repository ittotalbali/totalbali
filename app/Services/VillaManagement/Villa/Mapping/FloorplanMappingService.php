<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class FloorplanMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $floorplan = $dto['floorplan'];
        
        if($floorplan) {
            $data = [
                'name' => $floorplan->nama,
                'description' => $floorplan->deskripsi,
                'images' => $this->floorplanImageMapping($floorplan),
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }

    private function floorplanImageMapping($item) {
        $images = null;

        if($item->gambar) {
            $images = $item->gambar->map(function($dt) {
                return [
                    'image_url' => !empty($dt->gambar) ? asset('uploads/'. $dt->gambar) : null,
                    'description' => $dt->deskripsi,
                ];
            });
        }

        return $images;
    }
}
