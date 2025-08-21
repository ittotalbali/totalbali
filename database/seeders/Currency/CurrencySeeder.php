<?php

namespace Database\Seeders\Currency;

use App\Services\Currency\StoreCurrencyService;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'code' => 'USD',
                'name' => 'United States Dollar',
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
            ],
            [
                'code' => 'JPY',
                'name' => 'Japanese Yen',
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
            ],
            [
                'code' => 'AUD',
                'name' => 'Australian Dollar',
            ],
            [
                'code' => 'SGD',
                'name' => 'Singapore Dollar',
            ],
            [
                'code' => 'IDR',
                'name' => 'Indonesian Rupiah',
            ]
        ];

        foreach ($currencies as $currency) {
            (new StoreCurrencyService)->execute($currency);
        }
    }
}
