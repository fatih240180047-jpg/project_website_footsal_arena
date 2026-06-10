@extends('tata_letak.utama')
@section('judul', 'Daftar - Futsal Arena')

@section('konten')
<div style="max-width: 450px; margin: 40px auto;">
    <div class="card">
        <h2 class="text-center mb-2">Daftar Akun</h2>
        <p class="text-center mb-2">Buat akun baru untuk mulai reservasi</p>

        <form action="{{ route('autentikasi.prosesDaftar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required placeholder="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label for="kata_sandi">Kata Sandi</label>
                <input type="password" name="kata_sandi" id="kata_sandi" required>
            </div>

            <div class="form-group">
                <label for="kata_sandi_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primer" style="width: 100%;">Daftar</button>
        </form>

        <p class="text-center mt-4">
            Sudah punya akun? <a href="{{ route('autentikasi.masuk') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
