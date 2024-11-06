<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAndDrive extends Model
{
    use HasFactory;
    protected $table = "car_and_drives";
    protected $fillable = [
        'system_for_use',
        'car_currency',
        'cost',
        'information',
        'id_villa',
    ];
}
