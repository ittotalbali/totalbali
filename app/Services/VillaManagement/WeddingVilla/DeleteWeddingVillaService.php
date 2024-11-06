<?php

namespace App\Services\VillaManagement\WeddingVilla;

use App\Models\WeddingVilla;
use App\Services\BaseService;

class DeleteWeddingVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $weddingVilla = WeddingVilla::where('id', $dto['wedding_villa_id'])->first();

        if ($weddingVilla  == null)
        throw new \Exception("Wedding Villa Not Found", 404);

        if (!isset($dto['is_hard_delete'])) {
            $weddingVilla->delete();
        } else {
            $weddingVilla->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $weddingVilla
        ];
    }
}
