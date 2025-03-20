<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class MountainVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;

        $mountain = $dto['mountain'];

        if ($mountain) {
            $mountain_keys = array_keys($mountain->getAttributes());

            foreach ($mountain_keys as $key) {
                $value = $mountain->$key;

                if (empty($value)) {
                    $mountain->$key = null;
                }
            }

            $data = [
                'mountain_view' => $mountain->mountain_view,
                'view_of_ricefield' => $mountain->view_of_ricefield,
                'river_closeby' => $mountain->river_closeby,
                'waterfall_closeby' => $mountain->waterfall_closeby,
                'activities' => $mountain->activities,
                'track_information' => $mountain->track_information,
                'birdwatching' => $mountain->birdwatching,
                'guide' => $mountain->guide,
                'other' => $mountain->other,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
