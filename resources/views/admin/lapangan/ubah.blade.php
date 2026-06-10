@extends('tata_letak.utama')
@section('judul', 'Ubah Lapangan - Futsal Arena')

@section('konten')
<a href="{{ route('admin.lapangan.index') }}">&larr; Kembali ke Daftar Lapangan</a>

<div class="card mt-4">
    <h2>Ubah Lapangan: {{ $lapangan->nama_lapangan }}</h2>

    <form action="{{ route('admin.lapangan.perbarui', $lapangan->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_lapangan">Nama Lapangan</label>
            <input type="text" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi', $lapangan->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="harga_per_jam">Harga per Jam (Rp)</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="fasilitas">Fasilitas (satu per baris)</label>
            <textarea name="fasilitas" id="fasilitas" rows="4">{{ old('fasilitas', $lapangan->fasilitas ? implode("\n", $lapangan->fasilitas) : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto (opsional, kosongkan jika tidak diubah)</label>
            <input type="file" name="foto" id="foto" accept="image/*">
            @if($lapangan->foto)
                <p style="font-size:0.85em; color:#666;">Foto saat ini: {{ $lapangan->foto }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="aktif" {{ old('status', $lapangan->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $lapangan->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-sukses">Perbarui</button>
        <a href="{{ route('admin.lapangan.index') }}" class="btn btn-peringatan">Batal</a>
    </form>
</div>
@endsection
