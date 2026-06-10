<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    protected $fillable = [
        'pengguna_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'durasi',
        'total_harga',
        'status',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'total_harga' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke pengguna.
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    /**
     * Relasi ke lapangan.
     */
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id');
    }

    /**
     * Scope berdasarkan status.
     */
    public function scopeDenganStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk reservasi hari ini.
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', today());
    }

    /**
     * Scope untuk reservasi aktif (bukan dibatalkan).
     */
    public function scopeAktif($query)
    {
        return $query->whereNotIn('status', ['dibatalkan']);
    }

    /**
     * Akses total harga terformat.
     */
    public function getTotalHargaTerformatAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Akses label status.
     */
    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Dikonfirmasi',
            'dibatalkan' => 'Dibatalkan',
            'selesai' => 'Selesai',
            default => $this->status,
        };
    }
}
