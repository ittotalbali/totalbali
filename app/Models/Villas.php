<?php

namespace App\Models;

use App\Models\Service\Service;
use App\Models\Service\ServiceVilla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Villas extends Model
{
    use HasFactory;

    protected $table = "villas";
    protected $fillable = [
        'name', 
        'country_id', 
        'area_id', 
        'location_id', 
        'sub_location_id',
        'user_id', 
        'address', 
        'link_map', 
        'cor_lat', 
        'cor_long', 
        'type_accomodation',
        'privacy_type',
        'guest',
        'bedroom',
        'bed',
        'bathroom',
        'staff',
        'landsize',
        'buildingsize',
        'yearbuilt',
        'last_renovation',
        'pets',
        'wheelchair_friendly',
        'internet',
        'security_day',
        'security_night',
        'security_cctv',
        'code',
        'title',
        'short',
        'long',
        'old_link',
        'new_link',
        'airbnb_link',
        'bookingcom_link',
        'base_rate',
        'base_rate_currency',
        'camera',
        'weapon',
        'animal',
        'status',
        'max_guests',
        'extra_guest_charge',
        'link_ical',
        'villa_link',
        'villa_bvp',
    ];

    public function countries()
    {
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }
    public function area()
    {
        return $this->hasOne(Areas::class, 'id', 'area_id');
    }
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
    public function sublocation()
    {
        return $this->hasOne(SubLocation::class, 'id', 'sub_location_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function rate()
    {
        return $this->hasMany(Rates::class, 'villa_id', 'id');
    }
    public function galeries()
    {
        return $this->hasMany(GaleriVilla::class, 'villa_id', 'id');
    }
    public function facilities()
    {
        return $this->belongsToMany(Facilities::class, 'facilities_villas', 'villa_id', 'facility_id');
    }

    public function pool()
    {
        return $this->hasOne(Pool::class, 'id_villa', 'id');
    }
    public function bedrooms()
    {
        return $this->hasMany(bedroom::class, 'id_villa', 'id');
    }
    public function inclusions()
    {
        return $this->hasOne(Inclusions::class, 'id_villa', 'id');
    }
    public function retreats()
    {
        return $this->hasOne(Retreats::class, 'id_villa', 'id');
    }
    public function wedding()
    {
        return $this->hasOne(WeddingVilla::class, 'id_villa', 'id');
    }
    public function mountain()
    {
        return $this->hasOne(MountainVilla::class, 'id_villa', 'id');
    }
    public function close_clubs()
    {
        return $this->hasMany(CloseToTheClubs::class, 'id_villa', 'id');
    }
    public function family()
    {
        return $this->hasOne(FamilyVilla::class, 'id_villa', 'id');
    }
    public function beach()
    {
        return $this->hasOne(BeachVilla::class, 'id_villa', 'id');
    }
    public function staff_new()
    {
        return $this->hasOne(StaffAtVilla::class, 'id_villa', 'id');
    }
    public function chef()
    {
        return $this->hasOne(Chef::class, 'id_villa', 'id');
    }
    public function car()
    {
        return $this->hasOne(CarAndDrive::class, 'id_villa', 'id');
    }
    public function album()
    {
        return $this->hasMany(Album::class, 'id_villa', 'id');
    }
    public function floorplan()
    {
        return $this->hasOne(Floorplan::class, 'id_villa', 'id');
    }
    public function pricing()
    {
        return $this->hasOne(Pricing::class, 'id_villa', 'id');
    }

    public function calender()
    {
        return $this->hasMany(Calender::class, 'villa_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_villas', 'villa_id', 'service_id');
    }
}
