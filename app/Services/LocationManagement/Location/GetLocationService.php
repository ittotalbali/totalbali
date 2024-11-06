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
                $q->where('name','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['area_id'])) {
            $location->where('area_id', $dto['area_id']);
        }

        if (isset($dto['location_id']) ) {
            $result  = (object) [ 'data' => $location->where('id', $dto['location_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $location->get() ];
        }

        return $result;
    }
}
