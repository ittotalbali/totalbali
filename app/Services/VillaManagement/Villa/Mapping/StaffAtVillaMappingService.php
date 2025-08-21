<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class StaffAtVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $staff = $dto['staff'];
        
        if($staff) {
            $data = [
                'house_keeper' => $staff->house_keeper,
                'satpam' => $staff->satpam,
                'manager' => $staff->manager,
                'chef' => $staff->chef,
                'gardener' => $staff->gardener,
                'driver' => $staff->driver,
                'other' => $staff->other,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
