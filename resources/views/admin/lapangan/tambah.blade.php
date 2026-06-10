@extends('tata_letak.utama')
@section('judul', 'Tambah Lapangan - Futsal Arena')

@section('konten')
<a href="{{ route('admin.lapangan.index') }}">&larr; Kembali ke Daftar Lapangan</a>

<div class="card mt-4">
    <h2>Tambah Lapangan Baru</h2>

    <form action="{{ route('admin.lapangan.simpan') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="nama_lapangan">Nama Lapangan</label>
            <input type="text" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan') }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="harga_per_jam">Harga per Jam (Rp)</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam') }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="fasilitas">Fasilitas (satu per baris)</label>
            <textarea name="fasilitas" id="fasilitas" rows="4" placeholder="Rumput Sintetis&#10;Lampu LED&#10;Ruang Ganti">{{ old('fasilitas') }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto (opsional)</label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-sukses">Simpan</button>
        <a href="{{ route('admin.lapangan.index') }}" class="btn btn-peringatan">Batal</a>
    </form>
</div>
@endsection
