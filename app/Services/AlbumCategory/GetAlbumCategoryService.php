<?php

namespace App\Services\AlbumCategory;

use App\Models\AlbumCategory\AlbumCategory;
use App\Services\BaseService;

class GetAlbumCategoryService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $album_category = AlbumCategory::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $album_category->where(function ($q) use ($dto) {
                $q->where('code', 'like', '%' . $dto['search_param'] . '%')
                    ->orWhere('name', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['album_category_id'])) {
            $result = (object) ['data' => $album_category->where('id', $dto['album_category_id'])->first()];
        } else {
            $result = (object) ['data' => $album_category->get()];
        }

        return $result;
    }
}
