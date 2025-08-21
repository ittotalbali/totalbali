<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;

    protected $table = "rates";
    protected $guarded = ['id'];

    protected $casts = [
        'rooms' => 'array',
    ];

    public function villa()
    {
        return $this->hasOne(Villas::class, 'id', 'villa_id');
    }
}
