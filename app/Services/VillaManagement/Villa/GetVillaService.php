<?php

namespace App\Services\VillaManagement\Villa;

use App\Models\Rates;
use App\Models\Villas;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class GetVillaService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $dto['page'] = $dto['page'] ?? 1;
        $dto['length'] = $dto['length'] ?? 10;
        $dto['sort_by'] = $dto['sort_by'] ?? 'updated_at';
        $dto['sort_type'] = $dto['sort_type'] ?? 'desc';

        $villa = Villas::query()->orderBy($dto['sort_by'], $dto['sort_type']);
        $villa->with([
            'rate',
        ]);

        if (isset($dto['search_param'])) {
            $villa->where(function ($q) use ($dto) {
                $q->where('name', 'like', '%' . $dto['search_param'] . '%')
                    ->orWhere('code', 'like', '%' . $dto['search_param'] . '%');
            });
        }

        if (isset($dto['status'])) {
            $villa->where('status', $dto['status']);
        }

        if (isset($dto['limit'])) {
            $villa->limit($dto['limit']);
        }

        if (isset($dto['area_id'])) {
            $villa->where('area_id', $dto['area_id']);
        }

        if (isset($dto['location_id'])) {
            $villa->where('location_id', $dto['location_id']);
        }

        if (isset($dto['sub_location_id'])) {
            $villa->where('sub_location_id', $dto['sub_location_id']);
        }

        if (isset($dto['start_date']) && isset($dto['end_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('start_date', '<=', $dto['start_date'])
                    ->where('end_date', '>=', $dto['end_date']);
            });
        } else if (isset($dto['start_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('start_date', '=', $dto['start_date']);
            });
        } else if (isset($dto['end_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('end_date', '=', $dto['end_date']);
            });
        }

        if (isset($dto['bathroom'])) {
            $prop = 'bathroom';

            switch ($dto['bathroom']) {
                case $dto['bathroom']:
                    $villa->where($prop, $dto['bathroom']);
                    break;
            }
        }

        if (isset($dto['user_id'])) {
            $villa->where('user_id', $dto['user_id']);
        }

        if (isset($dto['villa_bvp'])) {
            $villa->where('villa_bvp', $dto['villa_bvp']);
        }
        if (isset($dto['slug'])) {
            $villa->where('slug', $dto['slug']);
        }
        if (isset($dto['whatsapp'])) {
            $villa->where('whatsapp', $dto['whatsapp']);
        }
        if (isset($dto['email'])) {
            $villa->where('email', $dto['email']);
        }
        if (isset($dto['type_accommodation'])) {
            $villa->where('type_accomodation', $dto['type_accommodation']);
        }

        if (isset($dto['freehold'])) {
            $villa->whereHas('pricing', function ($q) use ($dto) {
                $q->where('freehold', $dto['freehold']);
            });
        }

        if (isset($dto['leasehold'])) {
            $villa->whereHas('pricing', function ($q) use ($dto) {
                $q->where('leasehold', $dto['leasehold']);
            });
        }

        if (isset($dto['monthly_rental'])) {
            $villa->whereHas('pricing', function ($q) use ($dto) {
                $q->where('monthly_rental', $dto['monthly_rental']);
            });
        }

        if (isset($dto['yearly_rental'])) {
            $villa->whereHas('pricing', function ($q) use ($dto) {
                $q->where('yearly_rental', $dto['yearly_rental']);
            });
        }

        if (isset($dto['retreats_villa'])) {
            $villa->whereHas('retreats', function ($q) use ($dto) {
                if (!empty($dto['retreats_villa']['params'])) {
                    foreach ($dto['retreats_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if (isset($dto['mountain_villa'])) {
            $villa->whereHas('mountain', function ($q) use ($dto) {
                if (!empty($dto['mountain_villa']['params'])) {
                    foreach ($dto['mountain_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if (isset($dto['wedding_villa'])) {
            $villa->whereHas('wedding', function ($q) use ($dto) {
                if (!empty($dto['wedding_villa']['params'])) {
                    foreach ($dto['wedding_villa']['params'] as $key => $value) {
                        if (is_string($key)) {
                            $q->where($key, $value);
                        } else {
                            $q->where($value, '!=', null);
                        }
                    }
                }
            });
        }

        if (isset($dto['beach_villa'])) {
            $villa->whereHas('beach', function ($q) use ($dto) {
                if (!empty($dto['beach_villa']['params'])) {
                    foreach ($dto['beach_villa']['params'] as $value) {
                        if (
                            $value == 'surf_villa' or
                            $value == 'beachfront'
                        ) {
                            $q->where($value, 'yes');
                        } else {
                            $q->where($value, '!=', null);
                        }
                    }
                }
            });
        }

        if (isset($dto['family_villa'])) {
            $villa->whereHas('family', function ($q) use ($dto) {
                if (!empty($dto['family_villa']['params'])) {
                    foreach ($dto['family_villa']['params'] as $value) {
                        if ($value == 'chef') {
                            $q->where($value, 'yes');
                        } else {
                            $q->where($value, '!=', null);
                        }
                    }
                }
            });
        }

        if (isset($dto['close_clubs'])) {
            $villa->whereHas('close_clubs');
        }

        if (isset($dto['facilities'])) {
            $villa->whereHas('facilities', function ($q) use ($dto) {
                $q->whereIn('name', $dto['facilities']);
            });
        }

        if (isset($dto['price_min']) && isset($dto['price_max'])) {
            $villa->whereBetween('base_rate', [$dto['price_min'], $dto['price_max']]);
        }

        if (isset($dto['bedroom'])) {
            if ($dto['bedroom'] == 777) {
                $villas = $villa->whereHas('rate')->get();

                $villa = $villas->filter(function ($villa) {
                    $rooms = $villa->rate->map(function ($item) {
                        return $item->rooms;
                    });

                    foreach ($rooms as $room) {
                        foreach ($room as $dt) {
                            if ($dt['total_bedroom'] >= 7) {
                                return $villa;
                            }
                        }
                    }
                });
            } else {
                $villa->whereHas('rate', function ($q) use ($dto) {
                    $q->whereJsonContains('rooms', ['total_bedroom' => $dto['bedroom']]);
                });
            }
        }

        if (isset($dto['code'])) {
            $villa->where('code', $dto['code']);
        }

        if (isset($dto['lat']) && isset($dto['lng'])) {
            $lat = floatval($dto['lat']);
            $lng = floatval($dto['lng']);
            $zoom = isset($dto['zoom']) ? intval($dto['zoom']) : 18;

            $radius_km = match (true) {
                $zoom >= 18 => 1,
                $zoom >= 16 => 5,
                $zoom >= 14 => 10,
                default => 20,
            };

            $lat_delta = $radius_km / 111;
            $lng_delta = $radius_km / (111 * cos(deg2rad($lat)));

            $min_lat = $lat - $lat_delta;
            $max_lat = $lat + $lat_delta;
            $min_lng = $lng - $lng_delta;
            $max_lng = $lng + $lng_delta;

            $villa->whereRaw('CAST(cor_lat AS DECIMAL(10,6)) BETWEEN ? AND ?', [$min_lat, $max_lat])
                  ->whereRaw('CAST(cor_long AS DECIMAL(10,6)) BETWEEN ? AND ?', [$min_lng, $max_lng]);
        }

        if (isset($dto['villa_id'])) {
            $result  = (object) ['data' => $villa->where('id', $dto['villa_id'])->first()];
        } else {
            if (isset($dto['is_paginate'])) {
                $result = paginate($villa, [
                    'length' => $dto['length'] ?? 10,
                    'page' => $dto['page'] ?? 1
                ]);
            } else {
                $result  = (object) ['data' => ($villa instanceof Builder) ? $villa->get() : $villa];
            }
        }

        return $result;
    }
    public function print(array $dto = [], $result): mixed
    {
        $data = $result["data"];



        if (isset($dto['curs_exchanges_id'])) {
            $this->currencyConvertion($data, $dto['curs_exchanges_id']);
        }


        return $data;
    }

    public function printArr(array $dto = [], $result): mixed
    {


        $data = $result["data"];

        if (isset($dto['curs_exchanges_id'])) {

            foreach ($data as $index => $value) {
                $data[$index] = $this->currencyConvertion($value, $dto['curs_exchanges_id']);
            }
        }
        return $data;
    }


    private function getCurrencyConvertion(string $from, int $to)
    {
        $currencyQuery = DB::table('currency_exchanges')
            ->select(
                'currency_exchanges.id as exchange_id',
                'currency_exchanges.from_curs_id as from_currency_id',
                'currency_exchanges.to_curs_id as to_currency_id',
                'currency_exchanges.value as value',
                'from_currency.code as from_currency_code',
                'from_currency.name as from_currency_name',
                'to_currency.code as to_currency_code',
                'to_currency.name as to_currency_name'
            )
            ->join('currencies as from_currency', 'currency_exchanges.from_curs_id', '=', 'from_currency.id')
            ->join('currencies as to_currency', 'currency_exchanges.to_curs_id', '=', 'to_currency.id')
            ->where('from_currency.code', $from)
            ->where('currency_exchanges.to_curs_id', $to)
            ->first();

        if ($currencyQuery === null) {
            return null;
        }

        $currencyArray = $currencyQuery;

        return $currencyArray;
    }

    private function currencyConvertion(&$data, $to)
    {
        // base
        if (isset($data["base_rate_currency"])) {
            $conversionRates = $this->getCurrencyConvertion($data["base_rate_currency"], $to);
            if (!is_null($conversionRates) && $data["base_rate_currency"] != $conversionRates->to_currency_code) {

                if (!is_null($data["base_rate"])) {
                    $data["base_rate"] = $data["base_rate"] * $conversionRates->value;
                    $data["base_rate_currency"] = $conversionRates->to_currency_code;
                }
            }
        }

        // Wedding Villa
        if (isset($data["wedding_villa"])) {
            if (isset($data["wedding_villa"]["additional_function_fee_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["wedding_villa"]["additional_function_fee_currency"], $to);

                if (!is_null($conversionRates) && $data["wedding_villa"]["additional_function_fee_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["wedding_villa"]["additional_function_fee"])) {
                        $data["wedding_villa"]["additional_function_fee"] = sprintf("%d", $data["wedding_villa"]["additional_function_fee"] * $conversionRates->value);
                        $data["wedding_villa"]["additional_function_fee_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }

            if (isset($data["wedding_villa"]["banjar_fee_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["wedding_villa"]["banjar_fee_currency"], $to);

                if (!is_null($conversionRates) && $data["wedding_villa"]["banjar_fee_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["wedding_villa"]["banjar_fee"])) {
                        $data["wedding_villa"]["banjar_fee"] = sprintf("%d", $data["wedding_villa"]["banjar_fee"] * $conversionRates->value);
                        $data["wedding_villa"]["banjar_fee_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }

            if ((isset($data["wedding_villa"]["security_deposit_currency"]))) {
                $conversionRates = $this->getCurrencyConvertion($data["wedding_villa"]["security_deposit_currency"], $to);

                if (!is_null($conversionRates) && $data["wedding_villa"]["security_deposit_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["wedding_villa"]["security_deposit"])) {
                        $data["wedding_villa"]["security_deposit"] = sprintf("%d", $data["wedding_villa"]["security_deposit"] * $conversionRates->value);
                        $data["wedding_villa"]["security_deposit_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }

        // Family Villa
        if (isset($data["family_villa"])) {
            if (isset($data["family_villa"]["costs_for_chef_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["family_villa"]["costs_for_chef_currency"], $to);

                if (!is_null($conversionRates) && $data["family_villa"]["costs_for_chef_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["family_villa"]["costs_for_chef"])) {
                        $data["family_villa"]["costs_for_chef"] = sprintf("%d", $data["family_villa"]["costs_for_chef"] * $conversionRates->value);
                        $data["family_villa"]["costs_for_chef_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }

            if (isset($data["family_villa"]["nanny_cost_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["family_villa"]["nanny_cost_currency"], $to);

                if (!is_null($conversionRates) && $data["family_villa"]["nanny_cost_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["family_villa"]["nanny_cost"])) {
                        $data["family_villa"]["nanny_cost"] = sprintf("%d", $data["family_villa"]["nanny_cost"] * $conversionRates->value);
                        $data["family_villa"]["nanny_cost_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }

            if (isset($data["family_villa"]["included_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["family_villa"]["included_currency"], $to);

                if (!is_null($conversionRates) && $data["family_villa"]["included_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["family_villa"]["included"])) {
                        $data["family_villa"]["included"] = sprintf("%d", $data["family_villa"]["included"] * $conversionRates->value);
                        $data["family_villa"]["included_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }

        if (isset($data["rates"])) {
            // Rates - Season Rates
            if ((isset($data["rates"]["season_rates"]))) {
                foreach ($data["rates"]["season_rates"] as &$seasonRate) {
                    foreach ($seasonRate["rooms"] as &$room) {
                        if (isset($room["currency"])) {
                            $conversionRates = $this->getCurrencyConvertion($room["currency"], $to);

                            if (!is_null($conversionRates) && $room["currency"] != $conversionRates->to_currency_code) {
                                if (!is_null($room["price"])) {
                                    $room["price"] = sprintf("%d", $room["price"] * $conversionRates->value);
                                    $room["currency"] = $conversionRates->to_currency_code;
                                }
                            }
                        }
                    }
                }
            }

            if (isset($data["rates"]["special_rates"])) {
                if (isset($data["rates"]["special_rates"]["monthly_rates"]["monthly_currency"])) {
                    $conversionRates = $this->getCurrencyConvertion($data["rates"]["special_rates"]["monthly_rates"]["monthly_currency"], $to);

                    if (!is_null($conversionRates) && $data["rates"]["special_rates"]["monthly_rates"]["monthly_currency"] != $conversionRates->to_currency_code) {
                        if (!is_null($data["rates"]["special_rates"]["monthly_rates"]["monthly_cost"])) {
                            $data["rates"]["special_rates"]["monthly_rates"]["monthly_cost"] = sprintf("%d", $data["rates"]["special_rates"]["monthly_rates"]["monthly_cost"] * $conversionRates->value);
                            $data["rates"]["special_rates"]["monthly_rates"]["monthly_currency"] = $conversionRates->to_currency_code;
                        }
                    }
                }

                if (isset($data["rates"]["special_rates"]["yearly_rates"]["yearly_currency"])) {
                    $conversionRates = $this->getCurrencyConvertion($data["rates"]["special_rates"]["yearly_rates"]["yearly_currency"], $to);

                    if (!is_null($conversionRates) && $data["rates"]["special_rates"]["yearly_rates"]["yearly_currency"] != $conversionRates->to_currency_code) {
                        if (!is_null($data["rates"]["special_rates"]["yearly_rates"]["yearly_cost"])) {
                            $data["rates"]["special_rates"]["yearly_rates"]["yearly_cost"] = sprintf("%d", $data["rates"]["special_rates"]["yearly_rates"]["yearly_cost"] * $conversionRates->value);
                            $data["rates"]["special_rates"]["yearly_rates"]["yearly_currency"] = $conversionRates->to_currency_code;
                        }
                    }
                }
            }
        }



        // Car and Driver
        if (isset($data["car_and_driver"])) {
            if (isset($data["car_and_driver"]["car_cost_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["car_and_driver"]["car_cost_currency"], $to);

                if (!is_null($conversionRates) && $data["car_and_driver"]["car_cost_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["car_and_driver"]["car_cost"])) {
                        $data["car_and_driver"]["car_cost"] = sprintf("%d", $data["car_and_driver"]["car_cost"] * $conversionRates->value);
                        $data["car_and_driver"]["car_cost_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }


        // Chef
        if (isset($data["chef"])) {
            if (isset($data["chef"]["chef_cost_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["chef"]["chef_cost_currency"], $to);

                if (!is_null($conversionRates) && $data["chef"]["chef_cost_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["chef"]["chef_cost"])) {
                        $data["chef"]["chef_cost"] = sprintf("%d", $data["chef"]["chef_cost"] * $conversionRates->value);
                        $data["chef"]["chef_cost_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }

        // Available for Sales
        if (isset($data["available_for_sales"])) {
            if (isset($data["available_for_sales"]["available_for_sales_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["available_for_sales"]["available_for_sales_currency"], $to);

                if (!is_null($conversionRates) && $data["available_for_sales"]["available_for_sales_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["available_for_sales"]["available_for_sales_cost"])) {
                        $data["available_for_sales"]["available_for_sales_cost"] = sprintf("%d", $data["available_for_sales"]["available_for_sales_cost"] * $conversionRates->value);
                        $data["available_for_sales"]["available_for_sales_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }

        // Leasehold
        if (isset($data["leasehold"])) {
            if (isset($data["leasehold"]["leasehold_currency"])) {
                $conversionRates = $this->getCurrencyConvertion($data["leasehold"]["leasehold_currency"], $to);

                if (!is_null($conversionRates) && $data["leasehold"]["leasehold_currency"] != $conversionRates->to_currency_code) {
                    if (!is_null($data["leasehold"]["leasehold_cost"])) {
                        $data["leasehold"]["leasehold_cost"] = sprintf("%d", $data["leasehold"]["leasehold_cost"] * $conversionRates->value);
                        $data["leasehold"]["leasehold_currency"] = $conversionRates->to_currency_code;
                    }
                }
            }
        }

        return $data;
    }
}