<?php

namespace App\Http\Resources\API\LocationManagement;

use Illuminate\Http\Resources\Json\JsonResource;

class GetSubLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location_id' => $this->location_id,
        ];
    }
}
