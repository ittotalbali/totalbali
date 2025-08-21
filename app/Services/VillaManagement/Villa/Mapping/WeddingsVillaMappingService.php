<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class WeddingsVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;

        $wedding = $dto['wedding'];

        if ($wedding) {
            $wedding_keys = array_keys($wedding->getAttributes());

            foreach ($wedding_keys as $key) {
                $value = $wedding->$key;

                if (empty($value)) {
                    $wedding->$key = null;
                }
            }

            $data = [
                'standing_guests' => $wedding->standing_guests,
                'seated_guests' => $wedding->seated_guests,
                // 'ocean_views' => $wedding->ocean_views,
                // 'garden_weddings' => $wedding->garden_weddings,
                // 'beachfront' => $wedding->beachfront,
                // 'other' => $wedding->other,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
