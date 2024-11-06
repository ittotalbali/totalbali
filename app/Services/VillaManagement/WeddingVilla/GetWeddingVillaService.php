<?php

namespace App\Services\VillaManagement\WeddingVilla;

use App\Models\WeddingVilla;
use App\Services\BaseService;

class GetWeddingVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $weddingVilla = WeddingVilla::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $weddingVilla->where(function ($q) use ($dto) {
                $q->where('other_informasion','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['id_villa'])) {
            $weddingVilla->where('id_villa', $dto['id_villa']);
        }

        if (isset($dto['wedding_villa_id']) ) {
            $result  = (object) [ 'data' => $weddingVilla->where('id', $dto['wedding_villa_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $weddingVilla->get() ];
        }

        return $result;
    }
}
