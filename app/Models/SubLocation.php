<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    use HasFactory;
    protected $table = "sub_locations";
    protected $fillable = [
        'name',
        'location_id',
    ];

    public function location()
    {
        return $this->Belongsto(Location::class);
    }
}
