<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = "galeris";
    protected $fillable = [
        'title', 'image', 'villa_id', 'album_id', 'order_number'
    ];
}
