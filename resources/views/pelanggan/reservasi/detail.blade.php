@extends('tata_letak.utama')
@section('judul', 'Detail Reservasi - Futsal Arena')

@section('konten')
<a href="{{ route('pelanggan.reservasi.index') }}">&larr; Kembali ke Daftar Reservasi</a>

<div class="card mt-4">
    <h2>Detail Reservasi #{{ $reservasi->id }}</h2>

    <table class="mt-4">
        <tr>
            <th style="width:200px;">Status</th>
            <td><span class="badge badge-{{ $reservasi->status }}">{{ $reservasi->label_status }}</span></td>
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
            <th>Harga per Jam</th>
            <td>{{ $reservasi->lapangan->harga_terformat }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><strong style="font-size: 1.2em;">{{ $reservasi->total_harga_terformat }}</strong></td>
        </tr>
        <tr>
            <th>Pemesan</th>
            <td>{{ $reservasi->pengguna->nama }} ({{ $reservasi->pengguna->email }})</td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td>{{ $reservasi->pengguna->no_telepon }}</td>
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

<div class="card mt-4" style="background: #fffde7;">
    <h3>Informasi Pembayaran</h3>
    <p class="mt-2">Silakan lakukan pembayaran melalui transfer bank:</p>
    <table class="mt-2">
        <tr>
            <th style="width:150px;">Bank</th>
            <td>BCA (Bank Central Asia)</td>
        </tr>
        <tr>
            <th>No. Rekening</th>
            <td>1234567890</td>
        </tr>
        <tr>
            <th>Atas Nama</th>
            <td>Ulil Amri - Futsal Arena</td>
        </tr>
        <tr>
            <th>Jumlah Transfer</th>
            <td><strong>{{ $reservasi->total_harga_terformat }}</strong></td>
        </tr>
    </table>
    <p class="mt-2" style="font-size:0.9em; color:#666;">
        * Reservasi akan dikonfirmasi oleh admin setelah pembayaran diterima.<br>
        * Harap simpan bukti transfer sebagai referensi.
    </p>
</div>

@if(!in_array($reservasi->status, ['dibatalkan', 'selesai']))
    <div class="mt-4">
        <form action="{{ route('pelanggan.reservasi.batalkan', $reservasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?');">
            @csrf
            <button type="submit" class="btn btn-bahaya">Batalkan Reservasi</button>
        </form>
    </div>
@endif
@endsection
