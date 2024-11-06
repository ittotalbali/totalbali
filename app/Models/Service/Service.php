<?php

namespace App\Models\Service;

use App\Models\Villas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function villas()
    {
        return $this->belongsToMany(Villas::class, 'service_villas', 'service_id', 'villa_id');
    }
}
