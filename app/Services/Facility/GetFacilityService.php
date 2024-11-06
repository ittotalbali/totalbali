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
                $q->where('name','like','%'.$dto['search_param'] . '%');
            });
        }

        if (isset($dto['facility_id']) ) {
            $result  = (object) [ 'data' => $facility->where('id', $dto['facility_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $facility->get() ];
        }

        return $result;
    }
}
