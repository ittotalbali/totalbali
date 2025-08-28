<?php

namespace App\Services\LocationManagement\SubLocation;

use App\Models\SubLocation;
use App\Services\BaseService;

class GetSubLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $subLocation = SubLocation::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $subLocation->where(function ($q) use ($dto) {
                $q->where('name', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['location_id'])) {
            $subLocation->where('location_id', $dto['location_id']);
        }

        // Single record fetch
        if (isset($dto['sub_location_id'])) {
            $result = (object) [
                'data' => $subLocation->where('id', $dto['sub_location_id'])->first()
            ];
        } 
        // Paginated fetch
        elseif (isset($dto['is_paginate']) && $dto['is_paginate']) {
            $length = $dto['length'] ?? 10;
            $page = $dto['page'] ?? 1;

            $totalCount = $subLocation->count();

            $data = $subLocation->skip(($page - 1) * $length)
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
        // Full dataset fetch
        else {
            $result = (object) [
                'data' => $subLocation->get()
            ];
        }

        return $result;
    }
}
