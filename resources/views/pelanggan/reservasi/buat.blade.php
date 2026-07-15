@extends('tata_letak.pelanggan')
@section('judul', 'Buat Reservasi - Footsal Arena')

@section('konten')
<a href="{{ route('pelanggan.lapangan.detail', ['lapangan' => $lapangan->id, 'tanggal' => $tanggal]) }}">&larr; Kembali ke Detail Lapangan</a>

<div class="card mt-4">
    <h2>Buat Reservasi</h2>

    <div class="mt-4">
        <h4>{{ $lapangan->nama_lapangan }}</h4>
        <p>Harga: <strong>{{ $lapangan->harga_terformat }} / jam</strong></p>
    </div>

    <form action="{{ route('pelanggan.reservasi.simpan') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" min="{{ now()->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <select name="jam_mulai" id="jam_mulai" required>
                @foreach($slotTersedia as $slot)
                    @if($slot['tersedia'])
                        <option value="{{ $slot['jam_mulai'] }}">{{ $slot['jam_mulai'] }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <select name="jam_selesai" id="jam_selesai" required>
                @foreach($slotTersedia as $slot)
                    @if($slot['tersedia'])
                        <option value="{{ $slot['jam_selesai'] }}">{{ $slot['jam_selesai'] }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="card" style="background: #f0f8ff;">
            <p><strong>Estimasi Harga:</strong></p>
            <p id="estimasiHarga">Pilih jam mulai dan selesai untuk melihat estimasi.</p>
            <input type="hidden" name="harga_per_jam" id="harga_per_jam" value="{{ $lapangan->harga_per_jam }}">
        </div>

        <button type="submit" class="btn btn-sukses mt-4" style="width: 100%; padding: 12px;">Konfirmasi Reservasi</button>
    </form>
</div>

@push('skrip')
<script>
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    const hargaPerJam = parseFloat(document.getElementById('harga_per_jam').value);
    const estimasiHarga = document.getElementById('estimasiHarga');

    function hitungEstimasi() {
        const mulai = parseInt(jamMulai.value.split(':')[0]);
        const selesai = parseInt(jamSelesai.value.split(':')[0]);
        const durasi = selesai - mulai;

        if (durasi > 0) {
            const total = hargaPerJam * durasi;
            estimasiHarga.innerHTML = `Durasi: <strong>${durasi} jam</strong> x ${formatRupiah(hargaPerJam)} = <strong>${formatRupiah(total)}</strong>`;
        } else {
            estimasiHarga.textContent = 'Jam selesai harus setelah jam mulai.';
        }
    }

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    jamMulai.addEventListener('change', hitungEstimasi);
    jamSelesai.addEventListener('change', hitungEstimasi);
    hitungEstimasi();
</script>
@endpush
@endsection

