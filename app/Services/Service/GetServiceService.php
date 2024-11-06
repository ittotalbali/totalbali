<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use App\Services\BaseService;

class GetServiceService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $service = Service::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $service->where(function ($q) use ($dto) {
                $q->where('name','like','%'.$dto['search_param'] . '%');
            });
        }

        if (isset($dto['service_id']) ) {
            $result  = (object) [ 'data' => $service->where('id', $dto['service_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $service->get() ];
        }

        return $result;
    }
}
