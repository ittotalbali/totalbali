<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities_villas extends Model
{
    use HasFactory;
    protected $table = "facilities_villas";
    protected $fillable = [
        'villa_id', 'facility_id'
    ];

    public function facilities()
    {
        return $this->hasOne(Facilities::class, 'id', 'facility_id');
    }
    public function villas()
    {
        return $this->hasOne(Villas::class, 'id', 'villa_id');
    }
}
