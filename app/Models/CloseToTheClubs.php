<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseToTheClubs extends Model
{
    use HasFactory;
    protected $table = "close_to_the_clubs";
    protected $fillable = [
        'club_name',
        'type_of_club',
        'good_days',
        'id_villa',
        'other',
    ];

    public function villa() {
        return $this->belongsTo(Villas::class, 'id_villa', 'id');
    }
}
