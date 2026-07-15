<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Tampilkan daftar reservasi.
     */
    public function index(Request $request)
    {
        $query = Reservasi::with(['pengguna', 'lapangan']);

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->denganStatus($request->status);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $reservasi = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('admin.reservasi.index', compact('reservasi'));
    }

    /**
     * Tampilkan detail reservasi.
     */
    public function detail(Reservasi $reservasi)
    {
        $reservasi->load(['pengguna', 'lapangan']);

        return view('admin.reservasi.detail', compact('reservasi'));
    }

    /**
     * Konfirmasi reservasi.
     */
    public function konfirmasi(Reservasi $reservasi)
    {
        if ($reservasi->status !== 'pending') {
            return back()->with('error', 'Hanya reservasi pending yang dapat dikonfirmasi.');
        }

        $reservasi->update(['status' => 'dikonfirmasi']);

        return redirect()->route('admin.dashboard')->with('sukses', 'Reservasi berhasil dikonfirmasi.');
    }

    /**
     * Batalkan reservasi oleh admin.
     */
    public function batalkan(Request $request, Reservasi $reservasi)
    {
        if (in_array($reservasi->status, ['selesai', 'dibatalkan'])) {
            return back()->with('error', 'Reservasi ini tidak dapat dibatalkan.');
        }

        $keterangan = $request->input('keterangan', 'Dibatalkan oleh admin.');

        $reservasi->update([
            'status' => 'dibatalkan',
            'keterangan' => $keterangan,
        ]);

        return redirect()->route('admin.dashboard')->with('sukses', 'Reservasi berhasil dibatalkan.');
    }

    /**
     * Tandai reservasi selesai.
     */
    public function selesai(Reservasi $reservasi)
    {
        if ($reservasi->status !== 'dikonfirmasi') {
            return back()->with('error', 'Hanya reservasi yang sudah dikonfirmasi yang dapat diselesaikan.');
        }

        $reservasi->update(['status' => 'selesai']);

        return redirect()->route('admin.reservasi.index')->with('sukses', 'Reservasi ditandai selesai.');
    }
}
