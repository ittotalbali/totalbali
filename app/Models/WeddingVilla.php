<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingVilla extends Model
{
    use HasFactory;
    protected $table = "wedding_villas";
    protected $fillable = [
        'standing_guests',
        'seated_guests',
        'other_informasion',
        'additional_function_fee',
        'banjar_fee',
        'security_deposit',
        'music_curfew',
        'wedding_packages',
        'wedding_packages_information',
        'thumbnail',
        'id_villa',
        'additional_function_fee_currency',
        'banjar_fee_currency',
        'security_deposit_currency',
        'ocean_views',
        'garden_weddings',
        'beachfront',
    ];
}
