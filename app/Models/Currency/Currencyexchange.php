<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencyexchange extends Model
{
    use HasFactory;

    protected $table = 'currency_exchanges';

    protected $fillable = [
        'from_curs_id',
        'to_curs_id',
        'value',
    ];
}
