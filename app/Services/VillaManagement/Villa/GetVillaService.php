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

        if(isset($dto['status'])) {
            $villa->where('status', $dto['status']);
        }

        if(isset($dto['limit'])) {
            $villa->limit($dto['limit']);
        }

        if(isset($dto['area_id'])) {
            $villa->where('area_id', $dto['area_id']);
        }

        if(isset($dto['location_id'])) {
            $villa->where('location_id', $dto['location_id']);
        }

        if(isset($dto['sub_location_id'])) {
            $villa->where('sub_location_id', $dto['sub_location_id']);
        }

        if(isset($dto['start_date']) && isset($dto['end_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('start_date', '<=', $dto['start_date'])
                    ->where('end_date', '>=', $dto['end_date']);
            });
        }else if(isset($dto['start_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('start_date', '=', $dto['start_date']);
            });
        }else if(isset($dto['end_date'])) {
            $villa->whereDoesntHave('calender', function ($q) use ($dto) {
                $q->where('end_date', '=', $dto['end_date']);
            });
        }

        if(isset($dto['bathroom'])) {
            $prop = 'bathroom';

            switch ($dto['bathroom']) {
                case $dto['bathroom']:
                    $villa->where($prop, $dto['bathroom']);
                    break;
            }
        }

        if(isset($dto['user_id'])) {
            $villa->where('user_id', $dto['user_id']);
        }

        if(isset($dto['type_accommodation'])) {
            $villa->where('type_accomodation', $dto['type_accommodation']);
        }

        if(isset($dto['freehold'])) {
            $villa->whereHas('pricing', function($q) use ($dto) {
                $q->where('freehold', $dto['freehold']);
            });
        }

        if(isset($dto['leasehold'])) {
            $villa->whereHas('pricing', function($q) use ($dto) {
                $q->where('leasehold', $dto['leasehold']);
            });
        }

        if(isset($dto['monthly_rental'])) {
            $villa->whereHas('pricing', function($q) use ($dto) {
                $q->where('monthly_rental', $dto['monthly_rental']);
            });
        }

        if(isset($dto['yearly_rental'])) {
            $villa->whereHas('pricing', function($q) use ($dto) {
                $q->where('yearly_rental', $dto['yearly_rental']);
            });
        }

        if(isset($dto['retreats_villa'])) {
            $villa->whereHas('retreats', function($q) use ($dto) {
                if(!empty($dto['retreats_villa']['params'])) {
                    foreach($dto['retreats_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if(isset($dto['mountain_villa'])) {
            $villa->whereHas('mountain', function($q) use ($dto) {
                if(!empty($dto['mountain_villa']['params'])) {
                    foreach($dto['mountain_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if(isset($dto['wedding_villa'])) {
            $villa->whereHas('wedding', function($q) use ($dto) {
                if(!empty($dto['wedding_villa']['params'])) {
                    foreach($dto['wedding_villa']['params'] as $key => $value) {
                        if(
                            $key == 'standing_guests' or
                            $key == 'seated_guests' 
                            // $key == 'ocean_views'
                        ) {
                            $q->where($key, $value);
                        }else {
                            $q->where($value, '!=', null);
                        }
                    }
                }
            });
        }

        if(isset($dto['beach_villa'])) {
            $villa->whereHas('beach', function($q) use ($dto) {
                if(!empty($dto['beach_villa']['params'])) {
                    foreach($dto['beach_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if(isset($dto['family_villa'])) {
            $villa->whereHas('family', function($q) use ($dto) {
                if(!empty($dto['family_villa']['params'])) {
                    foreach($dto['family_villa']['params'] as $value) {
                        $q->where($value, '!=', null);
                    }
                }
            });
        }

        if(isset($dto['close_clubs'])) {
            $villa->whereHas('close_clubs');
        }

        if(isset($dto['facilities'])) {
            $villa->whereHas('facilities', function($q) use ($dto) {
                $q->whereIn('name', $dto['facilities']);
            });
        }

        if(isset($dto['price_min']) && isset($dto['price_max'])) {
            $villa->whereBetween('base_rate', [$dto['price_min'], $dto['price_max']]);
        }

        if(isset($dto['bedroom'])) {
            if($dto['bedroom'] == 8) {
                $villas = $villa->whereHas('rate')->get();

                $villa = $villas->filter(function($villa) {
                    $rooms = $villa->rate->map(function($item) {
                        return $item->rooms;
                    });

                    foreach($rooms as $room) {
                        foreach($room as $dt) {
                            if($dt['total_bedroom'] > 7) {
                                return $villa;
                            }
                        }
                    }
                });
            }else {
                $villa->whereHas('rate', function($q) use ($dto) {
                    $q->whereJsonContains('rooms', ['total_bedroom' => $dto['bedroom']]);
                });
            }
        }

        if(isset($dto['code'])) {
            $villa->where('code', $dto['code']);
        }

        if (isset($dto['villa_id']) ) {
            $result  = (object) [ 'data' => $villa->where('id', $dto['villa_id'])->first() ];
        } else {
            if (isset($dto['is_paginate'])) {
                $result = paginate($villa, [
                    'length' => $dto['length'] ?? 10,
                    'page' => $dto['page'] ?? 1
                ]);
            } else {
                $result  = (object) [ 'data' => ($villa instanceof Builder) ? $villa->get() : $villa ];
            }
        }

        return $result;
    }
}
