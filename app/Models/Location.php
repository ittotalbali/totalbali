<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = "locations";
    protected $fillable = [
        'name',
        'area_id',
        'latitude',
        'longitude',
    ];

    public function area()
    {
        return $this->hasOne(Areas::class, 'id', 'area_id');
    }
}
