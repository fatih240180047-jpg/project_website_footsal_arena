<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutentikasiController extends Controller
{
    /**
     * Tampilkan halaman masuk.
     */
    public function tampilkanMasuk()
    {
        return view('autentikasi.masuk');
    }

    /**
     * Proses masuk.
     */
    public function prosesMasuk(Request $request)
    {
        $kredensial = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Username wajib diisi.',
            'email.email'       => 'Format username tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari pengguna berdasarkan email
        $pengguna = Pengguna::where('email', $kredensial['email'])->first();

        // Verifikasi password ke kolom kata_sandi via getAuthPassword()
        // (tidak menggunakan $pengguna->kata_sandi langsung karena cast 'hashed' dapat mendistorsi nilai)
        if ($pengguna && Hash::check($kredensial['password'], $pengguna->getAuthPassword())) {
            Auth::login($pengguna, $request->boolean('ingat_saya'));
            $request->session()->regenerate();

            if ($pengguna->peran === 'admin') {
                return redirect()->route('admin.dashboard')->with('sukses', 'Selamat datang, ' . $pengguna->nama . '!');
            }

            return redirect()->route('pelanggan.lapangan.index')->with('sukses', 'Selamat datang, ' . $pengguna->nama . '!');
        }

        return back()->withErrors([
            'email' => 'Username atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman daftar.
     */
    public function tampilkanDaftar()
    {
        return view('autentikasi.daftar');
    }

    /**
     * Proses pendaftaran.
     */
    public function prosesDaftar(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'no_telepon' => 'required|string|max:20',
            'kata_sandi' => 'required|min:6|confirmed',
            'kata_sandi_confirmation' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
            'kata_sandi.min' => 'Kata sandi minimal 6 karakter.',
            'kata_sandi.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $pengguna = Pengguna::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_telepon' => $data['no_telepon'],
            'kata_sandi' => $data['kata_sandi'], // Akan di-hash otomatis oleh model
            'peran' => 'pelanggan',
        ]);

        Auth::login($pengguna);

        return redirect()->route('pelanggan.lapangan.index')->with('sukses', 'Pendaftaran berhasil! Selamat datang.');
    }

    /**
     * Proses keluar.
     */
    public function prosesKeluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('autentikasi.masuk')->with('sukses', 'Anda telah berhasil keluar.');
    }
}
