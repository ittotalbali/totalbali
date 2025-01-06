<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class FamilyVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $family = $dto['family'];
        
        if($family) {
            $family_keys = array_keys($family->getAttributes());

            foreach($family_keys as $key) {
                $value = $family->$key;

                if(empty($value)) {
                    $family->$key = null;
                }
            }

            $data = [
                'pool_fence' => $family->pool_fence,
                'baby_cot' => $family->baby_cot,
                'infant_cot' => $family->infant_cot,
                'baby_high_chair' => $family->baby_high_chair,
                'chef' => $family->chef,
                'costs_for_chef' => $family->costs_for_chef,
                'costs_for_chef_currency' => $family->costs_for_chef_currency,
                'nanny_cost' => $family->nanny_cost,
                'nanny_cost_currency' => $family->nanny_cost_currency,
                'included' => $family->included,
                'included_currency' => $family->included_currency,
                'image_url' => !empty($family->photos) ? asset('uploads/'. $family->photos) : null,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
