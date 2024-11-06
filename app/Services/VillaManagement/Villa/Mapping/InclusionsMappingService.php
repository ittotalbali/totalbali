<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class InclusionsMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $inclusions = $dto['inclusions'];
        
        if($inclusions) {
            $data = [
                'breakfast' => $inclusions->breakfast,
                'breakfast_description' => $inclusions->breakfast_description,
                'airport' => $inclusions->airport,
                'airport_description' => $inclusions->airport_description,
                'pijet' => $inclusions->pijet,
                'pijet_description' => $inclusions->pijet_description,
                'anything_else' => $inclusions->anything_else,
                'anything_else_description' => $inclusions->anything_else_description,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
