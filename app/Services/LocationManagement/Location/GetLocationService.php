<?php

namespace App\Services\LocationManagement\Location;

use App\Models\Location;
use App\Services\BaseService;

class GetLocationService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $location = Location::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $location->where(function ($q) use ($dto) {
                $q->where('name', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['area_id'])) {
            $location->where('area_id', $dto['area_id']);
        }

        // If looking for a single record
        if (isset($dto['location_id'])) {
            $result = (object) [
                'data' => $location->where('id', $dto['location_id'])->first()
            ];
        } 
        // If pagination is requested
        elseif (isset($dto['is_paginate']) && $dto['is_paginate']) {
            $length = $dto['length'] ?? 10;
            $page = $dto['page'] ?? 1;

            $totalCount = $location->count();

            $data = $location->skip(($page - 1) * $length)
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
                'data' => $location->get()
            ];
        }

        return $result;
    }
}
