<?php

namespace App\Services\AlbumCategory;

use App\Models\AlbumCategory\AlbumCategory;
use App\Services\BaseService;

class UpdateAlbumCategoryService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $album_category = AlbumCategory::where('id', $dto['album_category_id'])->first();

        if ($album_category == null)
            throw new \Exception("Album Category Not Found", 404);

        $album_category->update([
            "code" => $dto['code'] ?? $album_category->code,
            "name" => $dto['name'] ?? $album_category->name,
        ]);

        return (object) [
            "success" => true,
            "data" => $album_category
        ];
    }

    private function prepare($dto)
    {
        return $dto;
    }
}
