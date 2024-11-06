<?php

namespace App\Models\Service;

use App\Models\Villas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceVilla extends Model
{
    use HasFactory;

    protected $table = 'service_villas';

    protected $fillable = [
        'service_id',
        'villa_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function villa()
    {
        return $this->belongsTo(Villas::class);
    }
}
