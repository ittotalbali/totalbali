<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'uuid',
        'description',
        'summary',
        'villa_id',
    ];

    public function villa()
    {
        return $this->belongsTo(Villas::class, 'villa_id');
    }
}
