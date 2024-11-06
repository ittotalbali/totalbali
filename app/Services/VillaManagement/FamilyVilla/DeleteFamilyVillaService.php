<?php

namespace App\Services\VillaManagement\FamilyVilla;

use App\Models\FamilyVilla;
use App\Services\BaseService;

class DeleteFamilyVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $familyVilla = FamilyVilla::where('id', $dto['family_villa_id'])->first();

        if ($familyVilla  == null)
        throw new \Exception("Family Villa Not Found", 404);

        if (!isset($dto['is_hard_delete'])) {
            $familyVilla->delete();
        } else {
            $familyVilla->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $familyVilla
        ];
    }
}
