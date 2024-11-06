<?php

namespace Database\Seeders\Service;

use App\Services\Service\StoreServiceService;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Brankas',
            'Pool towel',
            'Internet Wi-Fi',
            'Television with Netflix',
            'Free Wireless Internet',
            'Balcony or Patio',
        ];

        foreach($services as $service) {
            (new StoreServiceService)->execute([
                'name' => $service
            ]);
        }
    }
}
