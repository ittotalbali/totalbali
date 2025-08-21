<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class AlbumsMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $albums = $dto['albums'];
        
        if($albums) {
            $data = $albums->map(function($album) {
                return [
                    'name' => $album->nama,
                    'album_category' => $album->albumCategory->name ?? 'N/A',
                    'description' => $album->deskripsi,
                    'galeries' => $album->galeri->map(function($item) {
                        return [
                            'title' => $item->title,
                            'image_url' => !empty($item->image) ? asset('uploads/'. $item->image) : null,
                            'order_number' => $item->order_number,
                        ];
                    }),
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
