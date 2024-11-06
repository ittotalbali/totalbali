<?php

namespace App\Services\VillaManagement\Rate;

use App\Models\Rates;
use App\Services\BaseService;

class GetRateService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $rate = Rates::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $rate->where(function ($q) use ($dto) {
                $q->where('details','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['villa_id'])) {
            $rate->where('villa_id', $dto['villa_id']);
        }

        if (isset($dto['rate_id']) ) {
            $result  = (object) [ 'data' => $rate->where('id', $dto['rate_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $rate->get() ];
        }

        return $result;
    }
}
