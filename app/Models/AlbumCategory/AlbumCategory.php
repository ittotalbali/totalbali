<?php

namespace App\Models\AlbumCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
    use HasFactory;

    protected $table = 'album_categories';

    protected $fillable = [
        'code',
        'name',
    ];
}
