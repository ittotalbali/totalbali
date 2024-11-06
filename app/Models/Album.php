<?php

namespace App\Models;

use App\Models\AlbumCategory\AlbumCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = "albums";
    protected $fillable = [
        'nama',
        'deskripsi',
        'thumbnail',
        'id_villa',
        'album_category_id',
    ];

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'album_id', 'id');
    }

    public function galeri_album()
    {
        return $this->hasMany(Galeri::class, 'album_id', 'id');
    }

    public function albumCategory() {
        return $this->belongsTo(AlbumCategory::class, 'album_category_id', 'id');
    }
}
