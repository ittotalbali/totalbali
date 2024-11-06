<?php

namespace App\Http\Resources\API\Facility;

use Illuminate\Http\Resources\Json\JsonResource;

class GetFacilityResource extends JsonResource
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
            'image_url' => !empty($this->image) ? asset('uploads/'. $this->image) : null,
            'description' => $this->description,
        ];
    }
}
