<?php

namespace App\Services\LocationManagement\Area;

use App\Models\Areas;
use App\Services\BaseService;

class GetAreaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $area = Areas::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $area->where(function ($q) use ($dto) {
                $q->where('name', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['country_id'])) {
            $area->where('country_id', $dto['country_id']);
        }

        // If looking for single record by ID
        if (isset($dto['area_id'])) {
            $result = (object) [
                'data' => $area->where('id', $dto['area_id'])->first()
            ];
        } 
        // If pagination requested
        elseif (isset($dto['is_paginate']) && $dto['is_paginate']) {
            $length = $dto['length'] ?? 10;
            $page = $dto['page'] ?? 1;

            $totalCount = $area->count();

            $data = $area->skip(($page - 1) * $length)
                ->take($length)
                ->get();

            $totalPages = (int) ceil($totalCount / $length);
            $hasMore = $page < $totalPages;

            $result = (object) [
                'data' => $data,
                'pagination' => (object) [
                    'total_count' => $totalCount,
                    'total_pages' => $totalPages,
                    'page' => (int) $page,
                    'size' => (int) $length,
                    'has_more' => $hasMore
                ]
            ];
        } 
        // Otherwise return all results
        else {
            $result = (object) [
                'data' => $area->get()
            ];
        }

        return $result;
    }
}
