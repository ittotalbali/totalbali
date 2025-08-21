<?php

namespace App\Services\VillaManagement\FamilyVilla;

use App\Models\FamilyVilla;
use App\Services\BaseService;

class UpdateFamilyVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $familyVilla = FamilyVilla::where('id', $dto['family_villa_id'])->first();

        if ( $familyVilla  == null )
        throw new \Exception("Family Villa Not Found", 404);

        $familyVilla->update([
            'id_villa' => $dto['id_villa'] ?? $familyVilla->id_villa,
            'pool_fence' => $dto['pool_fence'],
            'baby_cot' => $dto['baby_cot'],
            'infant_cot' => $dto['infant_cot'],
            'baby_high_chair' => $dto['baby_high_chair'],
            'chef' => $dto['chef'],
            'costs_for_chef' => $dto['costs_for_chef'],
            'nanny_cost' => $dto['nanny_cost'],
            'included' => $dto['included'],
            'photos' => $dto['photos'],
            'costs_for_chef_currency' => $dto['costs_for_chef_currency'],
            'nanny_cost_currency' => $dto['nanny_cost_currency'],
            'included_currency' => $dto['included_currency'],
            'kids_toys' => $dto['kids_toys'],
            'other' => $dto['other'],
        ]);

        return (object) [
            "success" => true,
            "data" => $familyVilla
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
