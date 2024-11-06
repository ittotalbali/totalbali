<?php

namespace App\Services\Currency;

use App\Models\Currency\Currency;
use App\Services\BaseService;

class UpdateCurrencyService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $currency = Currency::where('id', $dto['currency_id'])->first();

        if ( $currency  == null )
        throw new \Exception("Currency Not Found", 404);

        $currency->update([
            "code" => $dto['code'] ?? $currency->code,
            "name" => $dto['name'] ?? $currency->name,
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
