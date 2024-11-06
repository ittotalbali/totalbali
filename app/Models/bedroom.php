<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bedroom extends Model
{
    use HasFactory;
    protected $table = "bedrooms";
    protected $fillable = [
        'number_of_bedrooms',
        'type_of_bedroom',
        'people_can_stay_per_room',
        'extra_guest_charge',
        'max_guests',
        'id_villa',
    ];
    public function bathroom()
    {
        return $this->hasMany(Bathroom::class, 'id_bedroom', 'id');
    }
    public function bathrooms()
    {
        return $this->hasOne(Bathroom::class, 'id_bedroom', 'id');
    }
}
