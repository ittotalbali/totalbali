<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAtVilla extends Model
{
    use HasFactory;
    protected $table = "staff_at_villas";
    protected $fillable = [
        'house_keeper',
        'satpam',
        'manager',
        'chef',
        'gardener',
        'driver',
        'other',
        'id_villa',
    ];
    
}
