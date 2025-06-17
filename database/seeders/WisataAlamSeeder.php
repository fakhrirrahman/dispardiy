<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WisataAlam;

class WisataAlamSeeder extends Seeder
{
    public function run(): void
    {
        WisataAlam::insert([
            [
                'nama_wisata' => 'Curug Cipendok',
                'alamat' => 'Banyumas, Jawa Tengah',
                'deskripsi' => 'Air terjun indah di tengah hutan pinus.',
                'gambar' => 'cipendok.jpg',
                'jam_buka' => '07:00:00',
                'jam_tutup' => '17:00:00',
                'latitude' => -7.344000,
                'longitude' => 109.119500,
                'harga_tiket' => 10000.00,
                'rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_wisata' => 'Pantai Parangtritis',
                'alamat' => 'Bantul, Yogyakarta',
                'deskripsi' => 'Pantai terkenal dengan legenda Ratu Kidul.',
                'gambar' => 'parangtritis.jpg',
                'jam_buka' => '06:00:00',
                'jam_tutup' => '18:00:00',
                'latitude' => -8.026280,
                'longitude' => 110.328250,
                'harga_tiket' => 15000.00,
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambah data lain kalau mau
        ]);
    }
}
