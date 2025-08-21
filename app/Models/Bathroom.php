<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bathroom extends Model
{
    use HasFactory;
    protected $table = "bathrooms";
    protected $fillable = [
        'type_of_bathroom',
        'id_bedroom',
        'id_villa',
    ];
}
