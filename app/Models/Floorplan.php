<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floorplan extends Model
{
    use HasFactory;
    protected $table = "floorplans";
    protected $fillable = [
        'nama',
        'deskripsi',
        'id_villa',
    ];

    public function gambar()
    {
        return $this->hasMany(GambarFloorplan::class, 'id_floorplan', 'id');
    }

    public function galeri_floorplan()
    {
        return $this->hasMany(GambarFloorplan::class, 'id_floorplan', 'id');
    }
}
