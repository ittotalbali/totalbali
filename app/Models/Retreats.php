<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retreats extends Model
{
    use HasFactory;
    protected $table = "retreats";
    protected $fillable = [
        'workout_deck',
        'exclusive_rental',
        'house_chef',
        'views_from_workout',
        'gym',
        'id_villa',
    ];
}
