<?php

namespace App\Services\VillaManagement\Club;

use App\Models\CloseToTheClubs;
use App\Services\BaseService;

class DeleteClubService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $club = CloseToTheClubs::where('id', $dto['club_id'])->first();

        if ($club  == null)
        throw new \Exception("Club Not Found", 404);

        if (!isset($dto['is_hard_delete'])) {
            $club->delete();
        } else {
            $club->forcedelete();
        }

        return (object) [
            "success" => true,
            "data" => $club
        ];
    }
}
