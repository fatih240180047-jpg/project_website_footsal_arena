@extends('tata_letak.admin')
@section('judul', 'Manajemen Reservasi')

@section('konten')
<div class="mb-8 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
    <h2 class="text-lg font-black text-slate-800 tracking-tight">Manajemen Reservasi</h2>
    <p class="text-xs text-slate-400 font-semibold mt-1">Pantau, konfirmasi, dan kelola seluruh transaksi penyewaan lapangan futsal.</p>
</div>

{{-- Filter Card --}}
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 mb-6">
    <form method="GET" action="{{ route('admin.reservasi.index') }}" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label for="status" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Status</label>
            <select name="status" id="status" 
                class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="dikonfirmasi" {{ request('status') === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        
        <div class="flex-1 min-w-[200px]">
            <label for="tanggal" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" 
                class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
        </div>

        <div class="flex gap-2 shrink-0">
            <button type="submit" 
                class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-600/10 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                </svg>
                Filter
            </button>
            <a href="{{ route('admin.reservasi.index') }}" 
                class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Lapangan</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Jadwal Sewa</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($reservasi as $r)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-400">
                            #{{ $r->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center text-xs font-black">
                                    {{ substr($r->pengguna->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $r->pengguna->nama }}</p>
                                    <p class="text-[10px] text-slate-400 font-semibold">{{ $r->pengguna->no_telepon }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">
                            {{ $r->lapangan->nama_lapangan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-bold text-slate-800">{{ $r->tanggal->format('d/m/Y') }}</p>
                            <p class="text-xs text-slate-400 font-semibold mt-0.5">{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }} ({{ $r->durasi }} jam)</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-extrabold text-indigo-600">{{ $r->total_harga_terformat }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php
                                $cls = 'bg-amber-50 text-amber-700 border-amber-200/50';
                                if ($r->status == 'dikonfirmasi') $cls = 'bg-emerald-50 text-emerald-700 border-emerald-200/50';
                                elseif ($r->status == 'dibatalkan') $cls = 'bg-rose-50 text-rose-700 border-rose-200/50';
                                elseif ($r->status == 'selesai') $cls = 'bg-indigo-50 text-indigo-700 border-indigo-200/50';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $cls }}">
                                {{ $r->label_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-bold">
                            <a href="{{ route('admin.reservasi.detail', $r->id) }}" 
                                class="inline-flex items-center px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors border border-indigo-200/50">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-600">Tidak Ada Reservasi</p>
                            <p class="text-xs text-slate-400 mt-1">Belum ada transaksi penyewaan lapangan yang tercatat.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
