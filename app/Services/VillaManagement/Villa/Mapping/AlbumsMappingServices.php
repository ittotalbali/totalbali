<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class AlbumsMappingServices implements BaseService
{
    public function execute(array $dto = []): object
    {
        $albums = $dto['albums'] ?? collect();

        // Filter hanya album dengan nama 'Other' dan ambil maksimal 5
        $filteredAlbums = $albums->filter(function ($album) {
            return strtolower($album->nama) === 'other';
        })->take(5);

        // Ambil semua galeri dari album yang lolos filter, gabungkan jadi satu array
        $galeries = $filteredAlbums->flatMap(function ($album) {
            return $album->galeri->map(function ($item) {
                return [
                    'image_url' => !empty($item->image) ? asset('uploads/' . $item->image) : null,
                ];
            });
        })->values(); // reset index

        return (object) [
            'success' => true,
            'data' => $galeries,
        ];
    }
}
