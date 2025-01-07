<?php

namespace App\Services\VillaManagement\FamilyVilla;

use App\Models\FamilyVilla;
use App\Services\BaseService;

class StoreFamilyVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $familyVilla = FamilyVilla::create([
            'id_villa' => $dto['id_villa'] ?? null,
            'pool_fence' => $dto['pool_fence'] ?? null,
            'baby_cot' => $dto['baby_cot'] ?? null,
            'infant_cot' => $dto['infant_cot'] ?? null,
            'baby_high_chair' => $dto['baby_high_chair'] ?? null,
            'chef' => $dto['chef'] ?? null,
            'costs_for_chef' => $dto['costs_for_chef'] ?? null,
            'nanny_cost' => $dto['nanny_cost'] ?? null,
            'included' => $dto['included'] ?? null,
            'photos' => $dto['photos'] ?? null,
            'costs_for_chef_currency' => $dto['costs_for_chef_currency'] ?? null,
            'nanny_cost_currency' => $dto['nanny_cost_currency'] ?? null,
            'included_currency' => $dto['included_currency'] ?? null,
            'kids_toys' => $dto['kids_toys'] ?? null,
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
