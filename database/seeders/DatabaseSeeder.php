<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed basis data aplikasi.
     */
    public function run(): void
    {
        $this->call([
            PenggunaSeeder::class,
            LapanganSeeder::class,
        ]);
    }
}
