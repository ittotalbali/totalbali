<?php

namespace App\Services\VillaManagement\Club;

use App\Models\CloseToTheClubs;
use App\Services\BaseService;

class StoreClubService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $club = CloseToTheClubs::create([
            'id_villa' => $dto['id_villa'],
            'club_name' => $dto['club_name'],
            'type_of_club' => $dto['type_of_club'],
            'good_days' => $dto['good_days'],
            'other' => $dto['other'],
        ]);

        return (object) [
            "success" => true,
            "data" => $club
        ];
    }

    private function prepare ($dto) {
        return $dto;
    }
}
