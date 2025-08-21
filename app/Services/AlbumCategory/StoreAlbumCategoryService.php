<?php

namespace App\Services\AlbumCategory;

use App\Models\AlbumCategory\AlbumCategory;
use App\Services\BaseService;

class StoreAlbumCategoryService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $album_category = AlbumCategory::create([
            'code' => $dto['code'] ?? null,
            'name' => $dto['name'],
        ]);

        return (object) [
            "success" => true,
            "data" => $album_category
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
