<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class VillaIncludeMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $pool = $dto['pool'];
        
        if($pool) {
            $pool_keys = array_keys($pool->getAttributes());

            foreach($pool_keys as $key) {
                $value = $pool->$key;

                if(empty($value)) {
                    $pool->$key = null;
                }
            }

            $data = [
                'pool' => $pool->pool,
                'type' => $pool->type,
                'size_of_pool' => $pool->size_of_pool,
                'max_guests' => $dto['max_guests'],
                'extra_guest_charge' => $dto['extra_guest_charge'],
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
