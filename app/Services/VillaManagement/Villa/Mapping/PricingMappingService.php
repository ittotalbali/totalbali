<?php

namespace App\Services\VillaManagement\Villa\Mapping;

use App\Services\BaseService;

class PricingMappingService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $data = null;

        $pricing = $dto['pricing'];
        
        if($pricing) {
            $pricing_keys = array_keys($pricing->getAttributes());

            foreach($pricing_keys as $key) {
                $value = $pricing->$key;

                if(empty($value)) {
                    $pricing->$key = null;
                }
            }
            
            $data = [
                'monthly' => $this->monthlyPricingMapping($pricing),
                'yearly' => $this->yearlyPricingMapping($pricing),
                'available_for_sales' => $this->availableForSalesPricingMapping($pricing),
                'leasehold' => $this->leaseholdPricingMapping($pricing),
            ];
        }

        return (object) [
            'success' => true,
            'data' => $data
        ];
    }

    private function monthlyPricingMapping($item) {
        return [
            'monthly_rental' => $item->monthly_rental,
            'monthly_description' => $item->monthly_description,
            'monthly_currency' => $item->monthly_currency,
            'monthly_cost' => $item->monthly_cost,
        ];
    }

    private function yearlyPricingMapping($item) {
        return [
            'yearly_rental' => $item->yearly_rental,
            'yearly_description' => $item->yearly_description,
            'yearly_currency' => $item->yearly_currency,
            'yearly_cost' => $item->yearly_cost,
        ];
    }

    private function availableForSalesPricingMapping($item) {
        return [
            'available_for_sales_rental' => $item->available_for_sales_rental,
            'available_for_sales_description' => $item->available_for_sales_description,
            'available_for_sales_currency' => $item->available_for_sales_currency,
            'available_for_sales_cost' => $item->available_for_sales_cost,
        ];
    }

    private function leaseholdPricingMapping($item) {
        return [
            'leasehold' => $item->leasehold,
            'leasehold_description' => $item->leasehold_description,
            'leasehold_currency' => $item->leasehold_currency,
            'leasehold_cost' => $item->leasehold_cost,
            'leasehold_available_until' => $item->leasehold_available_until,
        ];
    }
}
