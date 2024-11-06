<?php

namespace App\Services\VillaManagement\Club;

use App\Models\CloseToTheClubs;
use App\Services\BaseService;

class UpdateClubService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto = $this->prepare($dto);

        $club = CloseToTheClubs::where('id', $dto['club_id'])->first();

        if ( $club  == null )
        throw new \Exception("Club Not Found", 404);

        $club->update([
            'id_villa' => $dto['id_villa'] ?? $club->id_villa,
            'club_name' => $dto['club_name'] ?? $club->club_name,
            'type_of_club' => $dto['type_of_club'] ?? $club->type_of_club,
            'good_days' => $dto['good_days'] ?? $club->good_days,
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
