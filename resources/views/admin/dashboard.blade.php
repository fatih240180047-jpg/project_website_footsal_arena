@extends('tata_letak.utama')
@section('judul', 'Dashboard Admin - Futsal Arena')

@section('konten')
<h2 class="mb-2">Dashboard Admin</h2>

<div class="grid" style="grid-template-columns: repeat(4, 1fr);">
    <div class="card text-center">
        <p style="font-size:0.9em; color:#666;">Total Lapangan</p>
        <p style="font-size:2em; font-weight:bold; color:#1a73e8;">{{ $totalLapangan }}</p>
        <p style="font-size:0.8em;">{{ $lapanganAktif }} aktif</p>
    </div>
    <div class="card text-center">
        <p style="font-size:0.9em; color:#666;">Total Pelanggan</p>
        <p style="font-size:2em; font-weight:bold; color:#28a745;">{{ $totalPelanggan }}</p>
    </div>
    <div class="card text-center">
        <p style="font-size:0.9em; color:#666;">Pendapatan Hari Ini</p>
        <p style="font-size:1.3em; font-weight:bold; color:#333;">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
    </div>
    <div class="card text-center">
        <p style="font-size:0.9em; color:#666;">Pendapatan Bulan Ini</p>
        <p style="font-size:1.3em; font-weight:bold; color:#333;">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
    </div>
</div>

<div class="card mt-4">
    <h3>Reservasi Menunggu Konfirmasi ({{ $reservasiPending->count() }})</h3>
    @if($reservasiPending->isEmpty())
        <p class="mt-2">Tidak ada reservasi pending.</p>
    @else
        <table class="mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Lapangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservasiPending as $r)
                    <tr>
                        <td>#{{ $r->id }}</td>
                        <td>{{ $r->pengguna->nama }}</td>
                        <td>{{ $r->lapangan->nama_lapangan }}</td>
                        <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $r->jam_mulai }} - {{ $r->jam_selesai }}</td>
                        <td>{{ $r->total_harga_terformat }}</td>
                        <td>
                            <a href="{{ route('admin.reservasi.detail', $r->id) }}" class="btn btn-primer" style="padding:3px 8px; font-size:0.8em;">Lihat</a>
                            <form action="{{ route('admin.reservasi.konfirmasi', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sukses" style="padding:3px 8px; font-size:0.8em;">Konfirmasi</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="card mt-4">
    <h3>Reservasi Hari Ini ({{ $reservasiHariIni->count() }})</h3>
    @if($reservasiHariIni->isEmpty())
        <p class="mt-2">Tidak ada reservasi hari ini.</p>
    @else
        <table class="mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Lapangan</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservasiHariIni as $r)
                    <tr>
                        <td>#{{ $r->id }}</td>
                        <td>{{ $r->pengguna->nama }}</td>
                        <td>{{ $r->lapangan->nama_lapangan }}</td>
                        <td>{{ $r->jam_mulai }} - {{ $r->jam_selesai }}</td>
                        <td><span class="badge badge-{{ $r->status }}">{{ $r->label_status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
