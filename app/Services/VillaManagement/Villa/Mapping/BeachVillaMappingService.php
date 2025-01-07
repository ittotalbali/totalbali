<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class BeachVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $beach = $dto['beach'];
        
        if($beach) {
            $beach_keys = array_keys($beach->getAttributes());

            foreach($beach_keys as $key) {
                $value = $beach->$key;

                if(empty($value)) {
                    $beach->$key = null;
                }
            }

            $data = [
                'what_beach' => $beach->what_beach,
                'how_far_walking' => $beach->how_far_walking,
                'views_of_ocean' => $beach->views_of_ocean,
                'surf_villa' => $beach->surf_villa,
                'waves_nearby' => $beach->waves_nearby,
                'extra_information' => $beach->extra_information,
                'other_information' => $beach->other_information,
                'beachfront' => $beach->beachfront,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
