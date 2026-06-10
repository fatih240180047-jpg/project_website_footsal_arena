<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Tampilkan daftar lapangan.
     */
    public function index()
    {
        $lapangan = Lapangan::orderBy('created_at', 'desc')->get();
        return view('admin.lapangan.index', compact('lapangan'));
    }

    /**
     * Tampilkan form tambah lapangan.
     */
    public function tambah()
    {
        return view('admin.lapangan.tambah');
    }

    /**
     * Simpan lapangan baru.
     */
    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nama_lapangan.required' => 'Nama lapangan wajib diisi.',
            'harga_per_jam.required' => 'Harga per jam wajib diisi.',
            'harga_per_jam.numeric' => 'Harga per jam harus berupa angka.',
        ]);

        // Parse fasilitas dari textarea (satu per baris) menjadi array
        $fasilitas = [];
        if (!empty($data['fasilitas'])) {
            $fasilitas = array_filter(array_map('trim', explode("\n", $data['fasilitas'])));
        }
        $data['fasilitas'] = $fasilitas;

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('lapangan', 'public');
            $data['foto'] = $path;
        }

        Lapangan::create($data);

        return redirect()->route('admin.lapangan.index')->with('sukses', 'Lapangan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form ubah lapangan.
     */
    public function ubah(Lapangan $lapangan)
    {
        return view('admin.lapangan.ubah', compact('lapangan'));
    }

    /**
     * Perbarui lapangan.
     */
    public function perbarui(Request $request, Lapangan $lapangan)
    {
        $data = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nama_lapangan.required' => 'Nama lapangan wajib diisi.',
            'harga_per_jam.required' => 'Harga per jam wajib diisi.',
            'harga_per_jam.numeric' => 'Harga per jam harus berupa angka.',
        ]);

        // Parse fasilitas
        $fasilitas = [];
        if (!empty($data['fasilitas'])) {
            $fasilitas = array_filter(array_map('trim', explode("\n", $data['fasilitas'])));
        }
        $data['fasilitas'] = $fasilitas;

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('lapangan', 'public');
            $data['foto'] = $path;
        } else {
            unset($data['foto']);
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan.index')->with('sukses', 'Lapangan berhasil diperbarui.');
    }

    /**
     * Hapus lapangan.
     */
    public function hapus(Lapangan $lapangan)
    {
        if ($lapangan->reservasi()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus lapangan yang memiliki reservasi.');
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')->with('sukses', 'Lapangan berhasil dihapus.');
    }
}
