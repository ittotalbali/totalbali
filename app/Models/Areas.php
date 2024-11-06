<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;
    protected $table = "areas";
    protected $fillable = [
        'name',
        'country_id',
    ];

    public function countries()
    {
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }
}
