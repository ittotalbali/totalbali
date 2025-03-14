<?php

namespace App\Services\VillaManagement\WeddingVilla;

use App\Models\WeddingVilla;
use App\Services\BaseService;

class UpdateWeddingVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $weddingVilla = WeddingVilla::where('id', $dto['wedding_villa_id'])->first();

        if ( $weddingVilla  == null )
        throw new \Exception("Wedding Villa Not Found", 404);

        $weddingVilla->update([
            'id_villa' => $dto['id_villa'] ?? $weddingVilla->id_villa,
            'standing_guests' => $dto['standing_guests'],
            'seated_guests' => $dto['seated_guests'],
            'other_informasion' => $dto['other_informasion'],
            'additional_function_fee' => $dto['additional_function_fee'],
            'banjar_fee' => $dto['banjar_fee'],
            'security_deposit' => $dto['security_deposit'],
            'music_curfew' => $dto['music_curfew'],
            'wedding_packages' => $dto['wedding_packages'],
            'wedding_packages_information' => $dto['wedding_packages_information'],
            'additional_function_fee_currency' => $dto['additional_function_fee_currency'],
            'banjar_fee_currency' => $dto['banjar_fee_currency'],
            'security_deposit_currency' => $dto['security_deposit_currency'],
            'ocean_views' => $dto['ocean_views'],
            'garden_weddings' => $dto['garden_weddings'],
            'beachfront' => $dto['beachfront'],
            'other' => $dto['other'],
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
