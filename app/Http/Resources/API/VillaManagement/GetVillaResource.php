<?php

namespace App\Http\Resources\API\VillaManagement;

use App\Services\VillaManagement\Villa\Mapping\AlbumsMappingService;
use App\Services\VillaManagement\Villa\Mapping\GaleriesMappingService;
use Illuminate\Http\Resources\Json\JsonResource;

class GetVillaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $data = $this->dataMapping();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'area' => $this->area->name ?? null,
            'location' => $this->location->name ?? null,
            'sub_location' => $this->sublocation->name ?? null,
            'type_of_accommodation' => $this->type_accomodation,
            'total_bedroom' => $this->bedroom,
            'total_bathroom' => $this->bathroom,
            'base_rate' => $this->base_rate,
            'base_rate_currency' => !empty($this->base_rate_currency) ? $this->base_rate_currency : null,
            'short_description' => $this->short,
            'long_description' => $this->long,
            'latitude' => $this->cor_lat,
            'longitude' => $this->cor_long,
            'map_url' => $this->link_map,
            'galeries' => $data['galeries'],
            'albums' => $data['albums'],
        ];
    }

    private function dataMapping() {
        return [
            'galeries' => (new GaleriesMappingService)->execute([
                'galeries' => $this->galeries
            ])->data,
            'albums' => (new AlbumsMappingService)->execute([
                'albums' => $this->album
            ])->data,
        ];
    }
}
