<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeachVilla extends Model
{
    use HasFactory;
    protected $table = "beach_villas";
    protected $fillable = [
        'what_beach',
        'how_far_walking',
        'views_of_ocean',
        'surf_villa',
        'waves_nearby',
        'extra_information',
        'other_information',
        'id_villa',
        'beachfront',
    ];
}
