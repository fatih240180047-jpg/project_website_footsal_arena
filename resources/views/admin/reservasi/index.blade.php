@extends('tata_letak.utama')
@section('judul', 'Manajemen Reservasi - Futsal Arena')

@section('konten')
<h2>Manajemen Reservasi</h2>

<div class="card mt-2">
    <form method="GET" action="{{ route('admin.reservasi.index') }}" style="display: flex; gap: 12px; align-items: end;">
        <div class="form-group" style="margin-bottom:0">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="dikonfirmasi" {{ request('status') === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom:0">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}">
        </div>
        <button type="submit" class="btn btn-primer">Filter</button>
        <a href="{{ route('admin.reservasi.index') }}" class="btn btn-peringatan">Reset</a>
    </form>
</div>

<table class="mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Lapangan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reservasi as $r)
            <tr>
                <td>#{{ $r->id }}</td>
                <td>{{ $r->pengguna->nama }}</td>
                <td>{{ $r->lapangan->nama_lapangan }}</td>
                <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                <td>{{ $r->jam_mulai }} - {{ $r->jam_selesai }}</td>
                <td>{{ $r->total_harga_terformat }}</td>
                <td><span class="badge badge-{{ $r->status }}">{{ $r->label_status }}</span></td>
                <td>
                    <a href="{{ route('admin.reservasi.detail', $r->id) }}" class="btn btn-primer" style="padding:3px 8px; font-size:0.8em;">Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada reservasi.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
