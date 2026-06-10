@extends('tata_letak.utama')
@section('judul', 'Cari Lapangan - Futsal Arena')

@section('konten')
<h2 class="mb-2">Cari Lapangan Futsal</h2>

<div class="card">
    <form method="GET" action="{{ route('pelanggan.lapangan.index') }}">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 12px; align-items: end;">
            <div class="form-group" style="margin-bottom:0">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" required>
            </div>
            <div class="form-group" style="margin-bottom:0">
                <label for="jam_mulai">Jam Mulai</label>
                <select name="jam_mulai" id="jam_mulai">
                    @for($i = 8; $i < 23; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}" {{ $jamMulai == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0">
                <label for="jam_selesai">Jam Selesai</label>
                <select name="jam_selesai" id="jam_selesai">
                    @for($i = 9; $i <= 23; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}" {{ $jamSelesai == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0">
                <label for="kata_kunci">Kata Kunci</label>
                <input type="text" name="kata_kunci" id="kata_kunci" value="{{ $kataKunci }}" placeholder="Nama lapangan...">
            </div>
            <div>
                <button type="submit" name="cari" value="1" class="btn btn-primer">Cari</button>
            </div>
        </div>
    </form>
</div>

@if(isset($lapanganTersedia))
    <h3 class="mt-4 mb-2">Lapangan Tersedia ({{ $lapanganTersedia->count() }} ditemukan)</h3>
    @if($lapanganTersedia->isEmpty())
        <div class="card text-center">
            <p>Tidak ada lapangan tersedia untuk jadwal yang dipilih.</p>
        </div>
    @else
        <div class="grid">
            @foreach($lapanganTersedia as $lp)
                <div class="card">
                    <h3>{{ $lp->nama_lapangan }}</h3>
                    <p style="font-size:0.9em; color:#666;">{{ Str::limit($lp->deskripsi, 80) }}</p>
                    <p class="mt-2"><strong>{{ $lp->harga_terformat }}</strong> / jam</p>
                    @if($lp->fasilitas)
                        <p style="font-size:0.85em; color:#555;" class="mt-2">
                            Fasilitas: {{ implode(', ', $lp->fasilitas) }}
                        </p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('pelanggan.reservasi.buat', ['lapangan_id' => $lp->id, 'tanggal' => $tanggal]) }}" class="btn btn-primer">Pesan</a>
                        <a href="{{ route('pelanggan.lapangan.detail', ['lapangan' => $lp->id, 'tanggal' => $tanggal]) }}" class="btn btn-peringatan">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@else
    <h3 class="mt-4 mb-2">Semua Lapangan</h3>
    <div class="grid">
        @foreach($semuaLapangan as $lp)
            <div class="card">
                <h3>{{ $lp->nama_lapangan }}</h3>
                <p style="font-size:0.9em; color:#666;">{{ Str::limit($lp->deskripsi, 80) }}</p>
                <p class="mt-2"><strong>{{ $lp->harga_terformat }}</strong> / jam</p>
                @if($lp->fasilitas)
                    <p style="font-size:0.85em; color:#555;" class="mt-2">
                        Fasilitas: {{ implode(', ', $lp->fasilitas) }}
                    </p>
                @endif
                <div class="mt-4">
                    <a href="{{ route('pelanggan.lapangan.detail', ['lapangan' => $lp->id]) }}" class="btn btn-primer">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
