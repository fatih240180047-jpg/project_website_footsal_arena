<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Menambahkan FK constraint sesi.user_id → pengguna.id sesuai ERD SKPL.
     */
    public function up(): void
    {
        Schema::table('sesi', function (Blueprint $table) {
            // Tambahkan FK constraint: Id_Pengguna → PENGGUNA.Id_Pengguna
            $table->foreign('user_id')
                  ->references('id')
                  ->on('pengguna')
                  ->onDelete('set null');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('sesi', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
