<?php

namespace App\Services;

use App\Models\Lapangan;
use App\Models\Reservasi;
use Carbon\Carbon;

class LayananKetersediaan
{
    /**
     * Cek ketersediaan lapangan untuk tanggal dan jam tertentu.
     */
    public function cekKetersediaan(int $lapanganId, string $tanggal, string $jamMulai, string $jamSelesai, ?int $kecualiReservasiId = null): bool
    {
        $lapangan = Lapangan::find($lapanganId);

        if (!$lapangan || $lapangan->status !== 'aktif') {
            return false;
        }

        return $lapangan->tersediaUntuk($tanggal, $jamMulai, $jamSelesai, $kecualiReservasiId);
    }

    /**
     * Dapatkan slot jam yang tersedia untuk lapangan pada tanggal tertentu.
     * Jam operasional: 08:00 - 23:00
     */
    public function dapatkanSlotTersedia(int $lapanganId, string $tanggal): array
    {
        $lapangan = Lapangan::find($lapanganId);

        if (!$lapangan || $lapangan->status !== 'aktif') {
            return [];
        }

        $jamBuka = 8;
        $jamTutup = 23;
        $slotTersedia = [];

        // Ambil semua reservasi aktif untuk tanggal tersebut
        $reservasiTerpakai = Reservasi::where('lapangan_id', $lapanganId)
            ->where('tanggal', $tanggal)
            ->whereNotIn('status', ['dibatalkan'])
            ->get();

        for ($jam = $jamBuka; $jam < $jamTutup; $jam++) {
            $jamMulai = sprintf('%02d:00', $jam);
            $jamSelesai = sprintf('%02d:00', $jam + 1);

            $terpakai = false;
            foreach ($reservasiTerpakai as $reservasi) {
                if ($reservasi->jam_mulai < $jamSelesai && $reservasi->jam_selesai > $jamMulai) {
                    $terpakai = true;
                    break;
                }
            }

            $slotTersedia[] = [
                'jam_mulai' => $jamMulai,
                'jam_selesai' => $jamSelesai,
                'tersedia' => !$terpakai,
            ];
        }

        return $slotTersedia;
    }

    /**
     * Hitung total harga berdasarkan durasi dan harga per jam.
     */
    public function hitungTotalHarga(Lapangan $lapangan, int $durasi): float
    {
        return $lapangan->harga_per_jam * $durasi;
    }

    /**
     * Hitung durasi dalam jam.
     */
    public function hitungDurasi(string $jamMulai, string $jamSelesai): int
    {
        $mulai = Carbon::parse($jamMulai);
        $selesai = Carbon::parse($jamSelesai);

        return $mulai->diffInHours($selesai);
    }

    /**
     * Dapatkan lapangan tersedia untuk pencarian berdasarkan tanggal dan jam.
     */
    public function cariLapanganTersedia(string $tanggal, string $jamMulai, string $jamSelesai): \Illuminate\Database\Eloquent\Collection
    {
        $lapanganAktif = Lapangan::aktif()->get();

        return $lapanganAktif->filter(function ($lapangan) use ($tanggal, $jamMulai, $jamSelesai) {
            return $lapangan->tersediaUntuk($tanggal, $jamMulai, $jamSelesai);
        })->values();
    }
}
