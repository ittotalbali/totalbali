<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyVilla extends Model
{
    use HasFactory;
    protected $table = "family_villas";
    protected $fillable = [
        'pool_fence',
        'baby_cot',
        'infant_cot',
        'baby_high_chair',
        'chef',
        'costs_for_chef',
        'nanny_cost',
        'included',
        'photos',
        'id_villa',
        'costs_for_chef_currency',
        'nanny_cost_currency',
        'included_currency',
        'kids_toys',
        'other',
    ];
}
