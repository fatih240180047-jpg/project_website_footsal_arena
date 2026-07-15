<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Services\LayananKetersediaan;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    protected LayananKetersediaan $layananKetersediaan;

    public function __construct(LayananKetersediaan $layananKetersediaan)
    {
        $this->layananKetersediaan = $layananKetersediaan;
    }

    /**
     * Tampilkan daftar reservasi milik pengguna.
     */
    public function index()
    {
        $reservasi = Reservasi::where('pengguna_id', auth()->id())
            ->with('lapangan')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('pelanggan.reservasi.index', compact('reservasi'));
    }

    /**
     * Tampilkan form reservasi.
     */
    public function buat(Request $request)
    {
        $lapanganId = $request->input('lapangan_id');
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));

        if (!$lapanganId) {
            return redirect()->route('pelanggan.lapangan.index')->with('error', 'Pilih lapangan terlebih dahulu.');
        }

        $lapangan = Lapangan::findOrFail($lapanganId);
        $slotTersedia = $this->layananKetersediaan->dapatkanSlotTersedia($lapangan->id, $tanggal);

        return view('pelanggan.reservasi.buat', compact('lapangan', 'slotTersedia', 'tanggal'));
    }

    /**
     * Simpan reservasi baru.
     */
    public function simpan(Request $request)
    {
        $data = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ], [
            'lapangan_id.required' => 'Lapangan wajib dipilih.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        $lapangan = Lapangan::findOrFail($data['lapangan_id']);

        // Cek ketersediaan
        $tersedia = $this->layananKetersediaan->cekKetersediaan(
            $lapangan->id,
            $data['tanggal'],
            $data['jam_mulai'],
            $data['jam_selesai']
        );

        if (!$tersedia) {
            return back()->with('error', 'Maaf, jadwal yang Anda pilih sudah dipesan. Silakan pilih jadwal lain.')->withInput();
        }

        $durasi = $this->layananKetersediaan->hitungDurasi($data['jam_mulai'], $data['jam_selesai']);
        $totalHarga = $this->layananKetersediaan->hitungTotalHarga($lapangan, $durasi);

        $reservasi = Reservasi::create([
            'pengguna_id' => auth()->id(),
            'lapangan_id' => $lapangan->id,
            'tanggal' => $data['tanggal'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'durasi' => $durasi,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        return redirect()->route('pelanggan.reservasi.detail', $reservasi->id)
            ->with('sukses', 'Reservasi berhasil dibuat! Silakan lakukan pembayaran untuk mengkonfirmasi.');
    }

    /**
     * Tampilkan detail reservasi.
     */
    public function detail(Reservasi $reservasi)
    {
        // Pastikan hanya pemilik yang bisa melihat
        if ($reservasi->pengguna_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke reservasi ini.');
        }

        $reservasi->load(['lapangan', 'pengguna']);

        return view('pelanggan.reservasi.detail', compact('reservasi'));
    }

    /**
     * Batalkan reservasi.
     */
    public function batalkan(Reservasi $reservasi)
    {
        if ($reservasi->pengguna_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke reservasi ini.');
        }

        if (in_array($reservasi->status, ['selesai', 'dibatalkan'])) {
            return back()->with('error', 'Reservasi ini tidak dapat dibatalkan.');
        }

        $reservasi->update(['status' => 'dibatalkan']);

        return back()->with('sukses', 'Reservasi berhasil dibatalkan.');
    }
}
