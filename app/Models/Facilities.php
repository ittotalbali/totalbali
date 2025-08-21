<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    use HasFactory;
    protected $table = "facilities";
    protected $fillable = [
        'name', 'image', 'description'
    ];
    public function villa()
    {
        return $this->belongsto(Facilities_villas::class, 'id', 'facility_id');
    }
    public function villas()
    {
        return $this->belongsToMany(Villas::class, 'facilities_villas', 'villa_id', 'facility_id');
    }
}
