@extends('tata_letak.admin')
@section('judul', 'Manajemen Lapangan')

@section('konten')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
    <div>
        <h2 class="text-lg font-black text-slate-800 tracking-tight">Daftar Lapangan</h2>
        <p class="text-xs text-slate-400 font-semibold mt-1">Kelola dan pantau seluruh fasilitas lapangan futsal yang tersedia.</p>
    </div>
    <a href="{{ route('admin.lapangan.tambah') }}"
        class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-200 shadow-lg shadow-indigo-600/20 hover:-translate-y-0.5">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Lapangan Baru
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Informasi Lapangan</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Harga Sewa</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Fasilitas</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($lapangan as $i => $l)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-400">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($l->foto)
                                    <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 border border-slate-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $l->foto) }}" alt="{{ $l->nama_lapangan }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-300 border border-slate-100 shrink-0 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.008-.008a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-extrabold text-slate-800">{{ $l->nama_lapangan }}</p>
                                    <p class="text-xs text-slate-400 font-semibold mt-0.5 max-w-xs truncate">{{ $l->deskripsi }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-extrabold text-indigo-600">{{ $l->harga_terformat }}</span>
                            <span class="text-[10px] text-slate-400 font-bold">/ jam</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($l->fasilitas)
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($l->fasilitas, 0, 3) as $f)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $f }}
                                        </span>
                                    @endforeach
                                    @if(count($l->fasilitas) > 3)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                            +{{ count($l->fasilitas) - 3 }} lagi
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs text-slate-400 font-semibold">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($l->status === 'aktif')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-400 border border-slate-200">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-bold">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.lapangan.ubah', $l->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors border border-amber-200/50">
                                    Ubah
                                </a>
                                <form action="{{ route('admin.lapangan.hapus', $l->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan {{ $l->nama_lapangan }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors border border-rose-200/50">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-600">Belum Ada Lapangan</p>
                            <p class="text-xs text-slate-400 mt-1">Silakan tambahkan lapangan baru untuk memulai reservasi.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
