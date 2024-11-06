<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;
    protected $table = "chefs";
    protected $fillable = [
        'chef',
        'chef_cost_currency',
        'cost',
        'information',
        'id_villa',
    ];
}
