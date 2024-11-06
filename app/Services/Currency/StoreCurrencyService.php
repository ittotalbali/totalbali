<?php

namespace App\Services\Currency;

use App\Models\Currency\Currency;
use App\Services\BaseService;

class StoreCurrencyService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $currency = Currency::create([
            'code' => $dto['code'],
            'name' => $dto['name'],
        ]);

        return (object) [
            "success" => true,
            "data" => $currency
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
