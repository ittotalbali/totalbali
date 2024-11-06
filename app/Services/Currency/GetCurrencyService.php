<?php

namespace App\Services\Currency;

use App\Models\Currency\Currency;
use App\Services\BaseService;

class GetCurrencyService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $currency = Currency::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $currency->where(function ($q) use ($dto) {
                $q->where('code','like','%'.$dto['search_param'] . '%')
                    ->orWhere('name','like','%'.$dto['search_param'] . '%');
            });
        }

        if (isset($dto['currency_id']) ) {
            $result  = (object) [ 'data' => $currency->where('id', $dto['currency_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $currency->get() ];
        }

        return $result;
    }
}
