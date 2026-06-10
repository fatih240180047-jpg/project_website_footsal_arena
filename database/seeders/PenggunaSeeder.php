<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Admin utama
        Pengguna::create([
            'nama' => 'Ulil Amri',
            'email' => 'admin@futsalarena.id',
            'no_telepon' => '081234567890',
            'kata_sandi' => 'admin123',
            'peran' => 'admin',
        ]);

        // Pelanggan uji
        Pengguna::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'no_telepon' => '089876543210',
            'kata_sandi' => 'pelanggan123',
            'peran' => 'pelanggan',
        ]);

        // Pelanggan tambahan
        Pengguna::create([
            'nama' => 'Andi Pratama',
            'email' => 'andi@email.com',
            'no_telepon' => '085678901234',
            'kata_sandi' => 'pelanggan123',
            'peran' => 'pelanggan',
        ]);
    }
}
