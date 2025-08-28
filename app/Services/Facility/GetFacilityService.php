<?php

namespace App\Services\Facility;

use App\Models\Facilities;
use App\Services\BaseService;

class GetFacilityService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $facility = Facilities::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $facility->where(function ($q) use ($dto) {
                $q->where('name', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['facility_id'])) {
            // single fetch, no pagination
            $result = (object)[
                'data' => $facility->where('id', $dto['facility_id'])->first(),
                'pagination' => null
            ];
        } else {
            // Check if pagination is requested
            if (!empty($dto['is_paginate'])) {
                $length = $dto['length'] ?? 10;
                $page = $dto['page'] ?? 1;

                $totalCount = $facility->count();

                $data = $facility
                    ->skip(($page - 1) * $length)
                    ->take($length)
                    ->get();

                $totalPages = ceil($totalCount / $length);
                $hasMore = $page < $totalPages;

                $result = (object)[
                    'data' => $data,
                    'pagination' => (object)[
                        'total_count' => $totalCount,
                        'total_pages' => $totalPages,
                        'page' => (int)$page,
                        'size' => (int)$length,
                        'has_more' => $hasMore,
                    ]
                ];
            } else {
                // no pagination, return all
                $result = (object)[
                    'data' => $facility->get(),
                    'pagination' => null
                ];
            }
        }

        return $result;
    }
}
