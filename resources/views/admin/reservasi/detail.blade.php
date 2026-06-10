@extends('tata_letak.utama')
@section('judul', 'Detail Reservasi #' . $reservasi->id . ' - Futsal Arena')

@section('konten')
<a href="{{ route('admin.reservasi.index') }}">&larr; Kembali ke Daftar Reservasi</a>

<div class="card mt-4">
    <h2>Detail Reservasi #{{ $reservasi->id }}</h2>

    <table class="mt-4">
        <tr>
            <th style="width:200px;">Status</th>
            <td><span class="badge badge-{{ $reservasi->status }}">{{ $reservasi->label_status }}</span></td>
        </tr>
        <tr>
            <th>Pelanggan</th>
            <td>{{ $reservasi->pengguna->nama }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $reservasi->pengguna->email }}</td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td>{{ $reservasi->pengguna->no_telepon }}</td>
        </tr>
        <tr>
            <th>Lapangan</th>
            <td>{{ $reservasi->lapangan->nama_lapangan }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $reservasi->tanggal->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <th>Jam</th>
            <td>{{ $reservasi->jam_mulai }} - {{ $reservasi->jam_selesai }} ({{ $reservasi->durasi }} jam)</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><strong>{{ $reservasi->total_harga_terformat }}</strong></td>
        </tr>
        <tr>
            <th>Tanggal Pesan</th>
            <td>{{ $reservasi->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
        </tr>
        @if($reservasi->keterangan)
        <tr>
            <th>Keterangan</th>
            <td>{{ $reservasi->keterangan }}</td>
        </tr>
        @endif
    </table>
</div>

<div class="mt-4" style="display: flex; gap: 12px;">
    @if($reservasi->status === 'pending')
        <form action="{{ route('admin.reservasi.konfirmasi', $reservasi->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sukses">Konfirmasi Reservasi</button>
        </form>
    @endif

    @if($reservasi->status === 'dikonfirmasi')
        <form action="{{ route('admin.reservasi.selesai', $reservasi->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primer">Tandai Selesai</button>
        </form>
    @endif

    @if(!in_array($reservasi->status, ['selesai', 'dibatalkan']))
        <form action="{{ route('admin.reservasi.batalkan', $reservasi->id) }}" method="POST" onsubmit="return confirm('Batalkan reservasi ini?');">
            @csrf
            <input type="hidden" name="keterangan" value="Dibatalkan oleh admin.">
            <button type="submit" class="btn btn-bahaya">Batalkan Reservasi</button>
        </form>
    @endif
</div>
@endsection
