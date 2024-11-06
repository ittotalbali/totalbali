<?php

namespace App\Services\VillaManagement\Rate;

use App\Models\Rates;
use App\Services\BaseService;

class DeleteRateService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $rate = Rates::where('id', $dto['rate_id'])->first();

        if ($rate  == null)
        throw new \Exception("Rate Not Found", 404);

        if (!isset($dto['is_hard_delete'])) {
            $rate->delete();
        } else {
            $rate->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $rate
        ];
    }
}
