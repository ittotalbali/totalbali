<?php

namespace App\Http\Resources\API\VillaManagement;

use App\Services\VillaManagement\Villa\Mapping\AlbumsMappingService;
use App\Services\VillaManagement\Villa\Mapping\BeachVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\BedroomsMappingService;
use App\Services\VillaManagement\Villa\Mapping\CarAndDriverMappingService;
use App\Services\VillaManagement\Villa\Mapping\ChefMappingService;
use App\Services\VillaManagement\Villa\Mapping\FacilitiesMappingService;
use App\Services\VillaManagement\Villa\Mapping\FamilyVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\FloorplanMappingService;
use App\Services\VillaManagement\Villa\Mapping\GaleriesMappingService;
use App\Services\VillaManagement\Villa\Mapping\InclusionsMappingService;
use App\Services\VillaManagement\Villa\Mapping\NearbyClubMappingService;
use App\Services\VillaManagement\Villa\Mapping\NearbyVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\PricingMappingService;
use App\Services\VillaManagement\Villa\Mapping\RatesMappingService;
use App\Services\VillaManagement\Villa\Mapping\RetreatsVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\RoomAvailabilityMappingService;
use App\Services\VillaManagement\Villa\Mapping\ServicesMappingService;
use App\Services\VillaManagement\Villa\Mapping\StaffAtVillaMappingService;
use App\Services\VillaManagement\Villa\Mapping\VillaCountMappingService;
use App\Services\VillaManagement\Villa\Mapping\VillaIncludeMappingService;
use App\Services\VillaManagement\Villa\Mapping\WeddingVillaMappingService;
use Illuminate\Http\Resources\Json\JsonResource;

class GetVillaDetailsResource extends JsonResource
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
            'area_id' => $this->area_id,
            'area' => $this->area->name ?? null,
            'location_id' => $this->location_id,
            'location' => $this->location->name ?? null,
            'sub_location_id' => $this->sub_location_id,
            'sub_location' => $this->sublocation->name ?? null,
            'type_of_accommodation' => $this->type_accomodation,
            'villa_count' => $data['villa_count'],
            'total_bedroom' => $this->bedroom,
            'total_bathroom' => $this->bathroom,
            'total_staff' => $this->staff,
            'land_size' => $this->landsize,
            'year_built' => $this->yearbuilt,
            'building_size' => $this->buildingsize,
            'short_description' => $this->short,
            'long_description' => $this->long,
            'pool_type' => $this->pool->type ?? null,
            'pets_allowed' => $this->pets,
            'latitude' => $this->cor_lat,
            'longitude' => $this->cor_long,
            'map_url' => $this->link_map,
            'rates' => $data['rates'],
            'galeries' => $data['galeries'],
            'albums' => $data['albums'],
            'bedrooms' => $data['bedrooms'],
            'floorplan' => $data['floorplan'],
            'available_for_sales' => $data['pricing']['available_for_sales'] ?? null,
            'leasehold' => $data['pricing']['leasehold'] ?? null,
            'room_availability' => $data['room_availability'],
            'facilities' => $data['facilities'],
            'inclusions' => $data['inclusions'],
            'services' => $data['services'],
            'staff_at_villa' => $data['staff_at_villa'],
            'security' => $data['security'],
            'chef' => $data['chef'],
            'car_and_driver' => $data['car_and_driver'],
            'retreats' => $data['retreats_villa'],
            'wedding_villa' => $data['wedding_villa'],
            'family_villa' => $data['family_villa'],
            'nearby_club' => $data['nearby_club'],
            'nearby_villa' => $data['nearby_villa'],
            'beach_villa' => $data['beach_villa'],
            'villa_include' => $data['villa_include'],
            'villa_bvp' => $this->villa_bvp,
        ];
    }

    private function dataMapping() {
        $pricing = (new PricingMappingService)->execute([
            'pricing' => $this->pricing
        ])->data;
        $rates = (new RatesMappingService)->execute([
            'rates' => $this->rate
        ])->data;
        
        if(!empty($rates)) {
            $special_rates = [
                'monthly_rates' => $pricing['monthly'] ?? null,
                'yearly_rates' => $pricing['yearly'] ?? null,
            ];
            
            $rates = [
                "season_rates" => $rates,
                "special_rates" => $special_rates
            ];
        }

        return [
            'rates' => $rates,
            'galeries' => (new GaleriesMappingService)->execute([
                'galeries' => $this->galeries
            ])->data,
            'albums' => (new AlbumsMappingService)->execute([
                'albums' => $this->album
            ])->data,
            'bedrooms' => (new BedroomsMappingService)->execute([
                'bedrooms' => $this->bedrooms
            ])->data,
            'floorplan' => (new FloorplanMappingService)->execute([
                'floorplan' => $this->floorplan
            ])->data,
            'pricing' => $pricing,
            'room_availability' => (new RoomAvailabilityMappingService)->execute([
                'calender' => $this->calender
            ])->data,
            'facilities' => (new FacilitiesMappingService)->execute([
                'facilities' => $this->facilities
            ])->data,
            'inclusions' => (new InclusionsMappingService)->execute([
                'inclusions' => $this->inclusions
            ])->data,
            'services' => (new ServicesMappingService)->execute([
                'services' => $this->services
            ])->data,
            'staff_at_villa' => (new StaffAtVillaMappingService)->execute([
                'staff' => $this->staff_new
            ])->data,
            'security' => [
                'security_cctv' => $this->security_cctv,
                'security_day' => $this->security_day,
                'security_night' => $this->security_night,
            ],
            'chef' => (new ChefMappingService)->execute([
                'chef' => $this->chef
            ])->data,
            'car_and_driver' => (new CarAndDriverMappingService)->execute([
                'car' => $this->car
            ])->data,
            'retreats_villa' => (new RetreatsVillaMappingService)->execute([
                'retreats' => $this->retreats
            ])->data,
            'wedding_villa' => (new WeddingVillaMappingService)->execute([
                'wedding' => $this->wedding
            ])->data,
            'family_villa' => (new FamilyVillaMappingService)->execute([
                'family' => $this->family
            ])->data,
            'nearby_club' => (new NearbyClubMappingService)->execute([
                'club' => $this->close_clubs
            ])->data,
            'villa_count' => (new VillaCountMappingService)->execute([
                'area_id' => $this->area_id,
                'location_id' => $this->location_id,
                'sub_location_id' => $this->sub_location_id,
                'type_accommodation' => $this->type_accomodation,
                'rates' => $this->rate,
                'total_bedroom' => $this->bedroom
            ])->data,
            'nearby_villa' => (new NearbyVillaMappingService)->execute([
                'villa_id' => $this->id,
                'location_id' => $this->location_id
            ])->data,
            'beach_villa' => (new BeachVillaMappingService)->execute([
                'beach' => $this->beach
            ])->data,
            'villa_include' => (new VillaIncludeMappingService)->execute([
                'pool' => $this->pool,
                'max_guests' => $this->max_guests,
                'extra_guest_charge' => $this->extra_guest_charge
            ])->data,
        ];
    }
}
