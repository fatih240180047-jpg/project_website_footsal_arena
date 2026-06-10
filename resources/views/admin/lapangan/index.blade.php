@extends('tata_letak.utama')
@section('judul', 'Manajemen Lapangan - Futsal Arena')

@section('konten')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Manajemen Lapangan</h2>
    <a href="{{ route('admin.lapangan.tambah') }}" class="btn btn-sukses">+ Tambah Lapangan</a>
</div>

<table class="mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lapangan</th>
            <th>Harga/Jam</th>
            <th>Fasilitas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($lapangan as $i => $l)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <strong>{{ $l->nama_lapangan }}</strong>
                    <br><small style="color:#666;">{{ Str::limit($l->deskripsi, 50) }}</small>
                </td>
                <td>{{ $l->harga_terformat }}</td>
                <td style="font-size:0.85em;">{{ $l->fasilitas ? implode(', ', $l->fasilitas) : '-' }}</td>
                <td><span class="badge badge-{{ $l->status === 'aktif' ? 'dikonfirmasi' : 'dibatalkan' }}">{{ ucfirst($l->status) }}</span></td>
                <td>
                    <a href="{{ route('admin.lapangan.ubah', $l->id) }}" class="btn btn-peringatan" style="padding:3px 8px; font-size:0.8em;">Ubah</a>
                    <form action="{{ route('admin.lapangan.hapus', $l->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus lapangan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-bahaya" style="padding:3px 8px; font-size:0.8em;">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada lapangan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
