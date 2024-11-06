<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inclusions extends Model
{
    use HasFactory;
    protected $table = "inclusions";
    protected $fillable = [
        'breakfast',
        'breakfast_description',
        'airport',
        'airport_description',
        'pijet',
        'pijet_description',
        'anything_else',
        'anything_else_description',
        'id_villa',
    ];
}
