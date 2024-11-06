<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MountainVilla extends Model
{
    use HasFactory;
    protected $table = "mountain_villas";
    protected $fillable = [
        'mountain_view',
        'view_of_ricefield',
        'rover_closeby',
        'waterfall_closeby',
        'activities',
        'track_information',
        'birdwatching',
        'guide',
        'id_villa',
    ];
}
