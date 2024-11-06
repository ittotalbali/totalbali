<?php

namespace App\Services\AlbumCategory;

use App\Models\AlbumCategory\AlbumCategory;
use App\Services\BaseService;

class DeleteAlbumCategoryService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $album_category = AlbumCategory::where('id', $dto['album_category_id'])->first();

        if ($album_category == null) {
            return (object) [
                "success" => false,
                "message" => "Album Category Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $album_category->delete();
        } else {
            $album_category->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $album_category
        ];
    }
}
