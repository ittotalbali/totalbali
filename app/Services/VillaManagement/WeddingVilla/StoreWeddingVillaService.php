<?php

namespace App\Services\VillaManagement\WeddingVilla;

use App\Models\WeddingVilla;
use App\Services\BaseService;

class StoreWeddingVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $weddingVilla = WeddingVilla::create([
            'id_villa' => $dto['id_villa'] ?? null,
            'standing_guests' => $dto['standing_guests'] ?? null,
            'seated_guests' => $dto['seated_guests'] ?? null,
            'other_informasion' => $dto['other_informasion'] ?? null,
            'additional_function_fee' => $dto['additional_function_fee'] ?? null,
            'banjar_fee' => $dto['banjar_fee'] ?? null,
            'security_deposit' => $dto['security_deposit'] ?? null,
            'music_curfew' => $dto['music_curfew'] ?? null,
            'wedding_packages' => $dto['wedding_packages'] ?? null,
            'wedding_packages_information' => $dto['wedding_packages_information'] ?? null,
            'additional_function_fee_currency' => $dto['additional_function_fee_currency'] ?? null,
            'banjar_fee_currency' => $dto['banjar_fee_currency'] ?? null,
            'security_deposit_currency' => $dto['security_deposit_currency'] ?? null,
            'ocean_views' => $dto['ocean_views'] ?? null,
            'garden_weddings' => $dto['garden_weddings'] ?? null,
            'beachfront' => $dto['beachfront'] ?? null,
            'other' => $dto['other'] ?? null,
        ]);

        return (object) [
            "success" => true,
            "data" => $weddingVilla
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
