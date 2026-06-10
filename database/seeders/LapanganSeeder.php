<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        Lapangan::create([
            'nama_lapangan' => 'Lapangan A - Rumput Sintetis',
            'deskripsi' => 'Lapangan futsal standar nasional dengan rumput sintetis berkualitas tinggi. Cocok untuk pertandingan serius dan latihan tim.',
            'harga_per_jam' => 150000,
            'fasilitas' => ['Rumput Sintetis', 'Lampu LED', 'Papan Skor', 'Ruang Ganti', 'Toilet', 'Parkir Luas'],
            'status' => 'aktif',
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan B - Vinyl',
            'deskripsi' => 'Lapangan indoor dengan lantai vinyl yang nyaman. Ideal untuk bermain santai bersama teman.',
            'harga_per_jam' => 120000,
            'fasilitas' => ['Lantai Vinyl', 'Lampu LED', 'Papan Skor', 'Ruang Ganti', 'Toilet'],
            'status' => 'aktif',
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan C - Interlock',
            'deskripsi' => 'Lapangan dengan lantai interlock yang empuk dan aman. Sesuai untuk segala usia.',
            'harga_per_jam' => 100000,
            'fasilitas' => ['Lantai Interlock', 'Lampu LED', 'Ruang Ganti', 'Toilet'],
            'status' => 'aktif',
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan VIP - Premium',
            'deskripsi' => 'Lapangan VIP dengan fasilitas premium, AC, dan ruang tunggu eksklusif. Untuk pengalaman bermain terbaik.',
            'harga_per_jam' => 250000,
            'fasilitas' => ['Rumput Sintetis Premium', 'AC', 'Lampu LED', 'Papan Skor Digital', 'Ruang Ganti VIP', 'Ruang Tunggu', 'Toilet Bersih', 'WiFi', 'Parkir VIP'],
            'status' => 'aktif',
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan D - Mini',
            'deskripsi' => 'Lapangan mini untuk anak-anak dan latihan kecil. Ukuran lebih kecil namun tetap menyenangkan.',
            'harga_per_jam' => 75000,
            'fasilitas' => ['Rumput Sintetis', 'Lampu LED'],
            'status' => 'aktif',
        ]);
    }
}
