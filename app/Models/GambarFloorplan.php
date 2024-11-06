<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarFloorplan extends Model
{
    use HasFactory;
    protected $table = "gambar_floorplans";
    protected $fillable = [
        'gambar',
        'deskripsi',
        'id_floorplan',
        'id_villa',
    ];
}
