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

    protected $casts = [
        'jam_buka' => 'time',
        'jam_tutup' => 'time',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'harga_tiket' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    
}
