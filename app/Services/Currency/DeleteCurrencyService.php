<?php

namespace App\Services\Currency;

use App\Models\Currency\Currency;
use App\Services\BaseService;

class DeleteCurrencyService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $currency = Currency::where('id', $dto['currency_id'])->first();

        if ($currency  == null) {
            return (object) [
                "success" => false,
                "message" => "Currency Not Found"
            ];
        }

        if (!isset($dto['is_hard_delete'])) {
            $currency->delete();
        } else {
            $currency->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $currency
        ];
    }
}
