<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class ChefMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $chef = $dto['chef'];
        
        if($chef) {
            $data = [
                'chef' => $chef->chef,
                'information' => $chef->information,
                'chef_cost' => $chef->cost,
                'chef_cost_currency' => !empty($chef->chef_cost_currency) ? $chef->chef_cost_currency : null,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
