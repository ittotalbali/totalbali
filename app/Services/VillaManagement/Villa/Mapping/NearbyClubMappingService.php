<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class NearbyClubMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $club = $dto['club'];
        
        if($club) {
            $data = $club->map(function($item) {
                return [
                    'club_name' => $item->club_name,
                    'type_of_club' => $item->type_of_club,
                    'good_days' => $item->good_days,
                    'other' => $item->other,
                ];
            });
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
