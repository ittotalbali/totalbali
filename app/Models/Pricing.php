<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table = "pricings";
    protected $fillable = [
        'monthly_rental',
        'monthly_description',
        'freehold_description',
        'yearly_rental',
        'yearly_description',
        'available_for_sales_rental',
        'available_for_sales_description',
        'id_villa',
    ];
}
