<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Services\LayananKetersediaan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    protected LayananKetersediaan $layananKetersediaan;

    public function __construct(LayananKetersediaan $layananKetersediaan)
    {
        $this->layananKetersediaan = $layananKetersediaan;
    }

    /**
     * Tampilkan daftar lapangan dengan pencarian.
     */
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        $jamMulai = $request->input('jam_mulai', '08:00');
        $jamSelesai = $request->input('jam_selesai', '09:00');
        $kataKunci = $request->input('kata_kunci', '');

        if ($request->has('cari')) {
            $lapanganTersedia = $this->layananKetersediaan->cariLapanganTersedia($tanggal, $jamMulai, $jamSelesai);

            if ($kataKunci) {
                $lapanganTersedia = $lapanganTersedia->filter(function ($lapangan) use ($kataKunci) {
                    return str_contains(strtolower($lapangan->nama_lapangan), strtolower($kataKunci));
                })->values();
            }

            $semuaLapangan = Lapangan::aktif()->get();
        } else {
            $semuaLapangan = Lapangan::aktif()->get();
            $lapanganTersedia = null;
        }

        return view('pelanggan.lapangan.index', compact('semuaLapangan', 'lapanganTersedia', 'tanggal', 'jamMulai', 'jamSelesai', 'kataKunci'));
    }

    /**
     * Tampilkan detail lapangan.
     */
    public function detail(Request $request, Lapangan $lapangan)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        $slotTersedia = $this->layananKetersediaan->dapatkanSlotTersedia($lapangan->id, $tanggal);

        return view('pelanggan.lapangan.detail', compact('lapangan', 'slotTersedia', 'tanggal'));
    }
}
