@extends('tata_letak.utama')
@section('judul', 'Masuk - Futsal Arena')

@section('konten')
<div style="max-width: 400px; margin: 40px auto;">
    <div class="card">
        <h2 class="text-center mb-2">Masuk</h2>
        <p class="text-center mb-2">Masuk ke akun Futsal Arena Anda</p>

        <form action="{{ route('autentikasi.prosesMasuk') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="kata_sandi">Kata Sandi</label>
                <input type="password" name="kata_sandi" id="kata_sandi" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="ingat_saya" value="1"> Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn btn-primer" style="width: 100%;">Masuk</button>
        </form>

        <p class="text-center mt-4">
            Belum punya akun? <a href="{{ route('autentikasi.daftar') }}">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
