<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $fillable = [
        'rate_id',
        'villa_id',
        'name',
        'address',
        'email',
        'start_date',
        'end_date',
        'rate_type',
        'rate_price',
        'rate_total',
        'status_data',
    ];

    public function villa()
    {
        return $this->hasOne(Villas::class, 'id', 'villa_id');
    }
    public function rate()
    {
        return $this->hasOne(Rates::class, 'id', 'rate_id');
    }
}
