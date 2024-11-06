<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVilla extends Model
{
    use HasFactory;
    protected $table = "galeri_villas";
    protected $fillable = [
        'title', 'image', 'villa_id'
    ];
}
