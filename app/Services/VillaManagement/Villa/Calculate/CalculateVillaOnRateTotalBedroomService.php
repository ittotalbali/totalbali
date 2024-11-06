<?php

namespace App\Services\VillaManagement\Villa\Calculate;

use App\Models\Villas;
use App\Services\BaseService;

class CalculateVillaOnRateTotalBedroomService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::whereHas('rate')
        ->where('status', 'post')
        ->where('area_id', $dto['area_id'])
        ->where('location_id', $dto['location_id'])
        ->where('sub_location_id', $dto['sub_location_id'])
        ->where('type_accomodation', $dto['type_accommodation'])
        ->get();
        $total_bedroom = $dto['total_bedroom'];

        $data = $villas->filter(function($villa) use($total_bedroom) {
            $rooms = $villa->rate->map(function($rate) {
                return $rate->rooms;
            });

            foreach($rooms as $item) {
                foreach($item as $dt) {
                    if($dt['total_bedroom'] == $total_bedroom) {
                        return $villa;
                    }
                }
            }
        })->count();

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }
}
