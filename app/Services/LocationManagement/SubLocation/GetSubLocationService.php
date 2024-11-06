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
                $q->where('name','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['location_id'])) {
            $subLocation->where('location_id', $dto['location_id']);
        }

        if (isset($dto['sub_location_id']) ) {
            $result  = (object) [ 'data' => $subLocation->where('id', $dto['sub_location_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $subLocation->get() ];
        }

        return $result;
    }
}
