<?php

namespace App\Services\VillaManagement\Club;

use App\Models\CloseToTheClubs;
use App\Services\BaseService;

class GetClubService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $club = CloseToTheClubs::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $club->where(function ($q) use ($dto) {
                $q->where('club_name','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['id_villa'])) {
            $club->where('id_villa', $dto['id_villa']);
        }

        if (isset($dto['club_id']) ) {
            $result  = (object) [ 'data' => $club->where('id', $dto['club_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $club->get() ];
        }

        return $result;
    }
}
