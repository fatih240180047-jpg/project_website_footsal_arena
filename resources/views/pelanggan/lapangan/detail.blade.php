@extends('tata_letak.utama')
@section('judul', $lapangan->nama_lapangan . ' - Futsal Arena')

@section('konten')
<a href="{{ route('pelanggan.lapangan.index') }}">&larr; Kembali ke Daftar Lapangan</a>

<div class="card mt-4">
    <h2>{{ $lapangan->nama_lapangan }}</h2>
    <p class="mt-2">{{ $lapangan->deskripsi }}</p>
    <p class="mt-2"><strong>Harga: {{ $lapangan->harga_terformat }} / jam</strong></p>
    <p><strong>Status:</strong> <span class="badge badge-{{ $lapangan->status === 'aktif' ? 'dikonfirmasi' : 'dibatalkan' }}">{{ ucfirst($lapangan->status) }}</span></p>

    @if($lapangan->fasilitas)
        <h4 class="mt-4">Fasilitas</h4>
        <ul style="margin-left: 20px;">
            @foreach($lapangan->fasilitas as $f)
                <li>{{ $f }}</li>
            @endforeach
        </ul>
    @endif
</div>

<div class="card mt-4">
    <h3>Jadwal Ketersediaan</h3>
    <form method="GET" action="{{ route('pelanggan.lapangan.detail', $lapangan->id) }}" style="margin-bottom: 12px;">
        <div style="display: flex; gap: 8px; align-items: end;">
            <div class="form-group" style="margin-bottom:0">
                <label for="tanggal">Pilih Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}">
            </div>
            <button type="submit" class="btn btn-primer">Lihat Jadwal</button>
        </div>
    </form>

    <p class="mb-2">Tanggal: <strong>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>Jam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slotTersedia as $slot)
                <tr>
                    <td>{{ $slot['jam_mulai'] }} - {{ $slot['jam_selesai'] }}</td>
                    <td>
                        @if($slot['tersedia'])
                            <span class="badge badge-dikonfirmasi">Tersedia</span>
                        @else
                            <span class="badge badge-dibatalkan">Terpakai</span>
                        @endif
                    </td>
                    <td>
                        @if($slot['tersedia'])
                            <form action="{{ route('pelanggan.reservasi.simpan') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                <input type="hidden" name="jam_mulai" value="{{ $slot['jam_mulai'] }}">
                                <input type="hidden" name="jam_selesai" value="{{ $slot['jam_selesai'] }}">
                                <button type="submit" class="btn btn-sukses" style="padding: 4px 10px; font-size: 0.85em;">Pesan</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
