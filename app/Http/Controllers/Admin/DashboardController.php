<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        $totalLapangan = Lapangan::count();
        $lapanganAktif = Lapangan::aktif()->count();
        $totalPelanggan = Pengguna::where('peran', 'pelanggan')->count();

        $reservasiHariIni = Reservasi::hariIni()->with(['lapangan', 'pengguna'])->get();
        $reservasiPending = Reservasi::denganStatus('pending')->with(['lapangan', 'pengguna'])->orderBy('tanggal', 'asc')->get();

        $pendapatanHariIni = Reservasi::hariIni()
            ->whereNotIn('status', ['dibatalkan'])
            ->sum('total_harga');

        $pendapatanBulanIni = Reservasi::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->whereNotIn('status', ['dibatalkan'])
            ->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalLapangan',
            'lapanganAktif',
            'totalPelanggan',
            'reservasiHariIni',
            'reservasiPending',
            'pendapatanHariIni',
            'pendapatanBulanIni'
        ));
    }
}
