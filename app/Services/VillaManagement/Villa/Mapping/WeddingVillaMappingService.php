<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class WeddingVillaMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;
        
        $wedding = $dto['wedding'];
        
        if($wedding) {
            $wedding_keys = array_keys($wedding->getAttributes());

            foreach($wedding_keys as $key) {
                $value = $wedding->$key;

                if(empty($value)) {
                    $wedding->$key = null;
                }
            }

            $data = [
                'standing_guests' => $wedding->standing_guests,
                'seated_guests' => $wedding->seated_guests,
                'additional_function_fee' => $wedding->additional_function_fee,
                'additional_function_fee_currency' => $wedding->additional_function_fee_currency,
                'banjar_fee' => $wedding->banjar_fee,
                'banjar_fee_currency' => $wedding->banjar_fee_currency,
                'security_deposit' => $wedding->security_deposit,
                'security_deposit_currency' => $wedding->security_deposit_currency,
                'other_information' => $wedding->other_informasion,
                'music_curfew' => $wedding->music_curfew,
                'wedding_packages' => $wedding->wedding_packages,
                'wedding_packages_information' => $wedding->wedding_packages_information,
                'ocean_views' => $wedding->ocean_views,
                'garden_weddings' => $wedding->garden_weddings,
                'beachfront' => $wedding->beachfront,
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
