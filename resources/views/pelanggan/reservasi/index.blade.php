@extends('tata_letak.utama')
@section('judul', 'Reservasi Saya - Futsal Arena')

@section('konten')
<h2 class="mb-2">Reservasi Saya</h2>

@if($reservasi->isEmpty())
    <div class="card text-center">
        <p>Anda belum memiliki reservasi.</p>
        <a href="{{ route('pelanggan.lapangan.index') }}" class="btn btn-primer mt-2">Cari Lapangan</a>
    </div>
@else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Durasi</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservasi as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $r->lapangan->nama_lapangan }}</td>
                    <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $r->jam_mulai }} - {{ $r->jam_selesai }}</td>
                    <td>{{ $r->durasi }} jam</td>
                    <td>{{ $r->total_harga_terformat }}</td>
                    <td><span class="badge badge-{{ $r->status }}">{{ $r->label_status }}</span></td>
                    <td>
                        <a href="{{ route('pelanggan.reservasi.detail', $r->id) }}" class="btn btn-primer" style="padding: 4px 8px; font-size: 0.8em;">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
