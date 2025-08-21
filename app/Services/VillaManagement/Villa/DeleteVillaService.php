<?php

namespace App\Services\VillaManagement\Villa;

use App\Models\Villas;
use App\Services\BaseService;

class DeleteVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villa = Villas::where('id', $dto['villa_id'])->first();

        if($villa == null)
        throw new \Exception("Villa Not Found", 404);

        if (!isset($dto['is_hard_delete'])) {
            $villa->delete();
        } else {
            $villa->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $villa
        ];
    }
}
