<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class AlbumsMappingServices implements BaseService
{
    public function execute(array $dto = []): object
    {
        $albums = $dto['albums'] ?? collect();

        $galeries = $albums->filter(function ($album) {
            return strtolower($album->nama) === 'other';
        })->flatMap(function ($album) {
            return $album->galeri->map(function ($item) {
                return [
                    'image_url' => !empty($item->image) ? asset('uploads/' . $item->image) : null,
                ];
            });
        })->take(5) // <-- limit di level foto
            ->values();

        return (object) [
            'success' => true,
            'data' => $galeries,
        ];
    }
}
