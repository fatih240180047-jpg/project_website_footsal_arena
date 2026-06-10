<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'lapangan';

    protected $fillable = [
        'nama_lapangan',
        'deskripsi',
        'harga_per_jam',
        'fasilitas',
        'foto',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'harga_per_jam' => 'decimal:2',
            'fasilitas' => 'array',
        ];
    }

    /**
     * Relasi ke reservasi.
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'lapangan_id');
    }

    /**
     * Scope untuk lapangan aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Akses harga terformat.
     */
    public function getHargaTerformatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_per_jam, 0, ',', '.');
    }

    /**
     * Cek ketersediaan untuk tanggal dan jam tertentu.
     */
    public function tersediaUntuk(string $tanggal, string $jamMulai, string $jamSelesai, ?int $kecualiReservasiId = null): bool
    {
        $query = $this->reservasi()
            ->where('tanggal', $tanggal)
            ->whereNotIn('status', ['dibatalkan'])
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                $q->where(function ($q2) use ($jamMulai, $jamSelesai) {
                    $q2->where('jam_mulai', '<', $jamSelesai)
                       ->where('jam_selesai', '>', $jamMulai);
                });
            });

        if ($kecualiReservasiId) {
            $query->where('id', '!=', $kecualiReservasiId);
        }

        return $query->count() === 0;
    }
}
