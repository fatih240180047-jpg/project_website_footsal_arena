<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'no_telepon',
        'peran',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_terverifikasi_pada' => 'datetime',
            'kata_sandi' => 'hashed',
        ];
    }

    /**
     * Cek apakah pengguna adalah admin.
     */
    public function apakahAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    /**
     * Cek apakah pengguna adalah pelanggan.
     */
    public function apakahPelanggan(): bool
    {
        return $this->peran === 'pelanggan';
    }

    /**
     * Relasi ke reservasi.
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'pengguna_id');
    }

    /**
     * Override getAuthPassword untuk menggunakan kolom kata_sandi.
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
