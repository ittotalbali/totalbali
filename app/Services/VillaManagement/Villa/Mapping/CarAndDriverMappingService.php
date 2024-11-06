<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class CarAndDriverMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $car = $dto['car'];
        
        if($car) {
            $data = [
                'system_for_use' => $car->system_for_use,
                'information' => $car->information,
                'car_cost' => $car->cost,
                'car_cost_currency' => !empty($car->car_currency) ? $car->car_currency : null,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
