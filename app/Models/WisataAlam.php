<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WisataAlam extends Model
{

    protected $table = 'wisata_alam';

    protected $fillable = [
        'nama_wisata',
        'alamat',
        'deskripsi',
        'gambar',
        'jam_buka',
        'jam_tutup',
        'latitude',
        'longitude',
        'harga_tiket',
        'rating'
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/wisata/' . $this->gambar) : null;
    }
}
