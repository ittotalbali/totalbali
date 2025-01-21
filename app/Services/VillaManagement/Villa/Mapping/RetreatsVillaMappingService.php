<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class RetreatsVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $retreats = $dto['retreats'];
        
        if($retreats) {
            $data = [
                'workout_deck' => $retreats->workout_deck,
                'exclusive_rental' => $retreats->exclusive_rental,
                'house_chef' => $retreats->house_chef,
                'views_from_workout' => $retreats->views_from_workout,
                'gym' => $retreats->gym,
                'other' => $retreats->other,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
