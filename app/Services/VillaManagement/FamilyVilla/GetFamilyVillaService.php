<?php

namespace App\Services\VillaManagement\FamilyVilla;

use App\Models\FamilyVilla;
use App\Services\BaseService;

class GetFamilyVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $familyVilla = FamilyVilla::query()->orderBy($dto['sort_by'], $dto['sort_type']);

        if (isset($dto['search_param'])) {
            $familyVilla->where(function ($q) use ($dto) {
                $q->where('pool_fence','like','%'.$dto['search_param'] . '%');
            });
        }

        if(isset($dto['id_villa'])) {
            $familyVilla->where('id_villa', $dto['id_villa']);
        }

        if (isset($dto['family_villa_id']) ) {
            $result  = (object) [ 'data' => $familyVilla->where('id', $dto['family_villa_id'])->first() ];
        } else {
            $result  = (object) [ 'data' => $familyVilla->get() ];
        }

        return $result;
    }
}
