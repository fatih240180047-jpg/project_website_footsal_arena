@extends('tata_letak.admin')
@section('judul', 'Ubah Lapangan')

@section('konten')
<div class="mb-6">
    <a href="{{ route('admin.lapangan.index') }}"
        class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors group">
        <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali ke Daftar Lapangan
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-xl font-black text-slate-800 tracking-tight">Ubah Data Lapangan</h2>
        <p class="text-xs text-slate-400 font-semibold mt-1">Perbarui detail dan pengaturan untuk lapangan <span class="text-indigo-600 font-bold">{{ $lapangan->nama_lapangan }}</span>.</p>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <form action="{{ route('admin.lapangan.perbarui', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 md:p-8 space-y-6">
                
                {{-- Nama Lapangan --}}
                <div>
                    <label for="nama_lapangan" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lapangan <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" required 
                        placeholder="Contoh: Lapangan A (Sintetis)"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 shadow-sm bg-slate-50/50 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('nama_lapangan') border-rose-300 bg-rose-50/20 @enderror">
                    @error('nama_lapangan')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deskripsi Lapangan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" 
                        placeholder="Berikan detail singkat mengenai kondisi lapangan, tipe rumput, dll..."
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 shadow-sm bg-slate-50/50 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('deskripsi') border-rose-300 bg-rose-50/20 @enderror">{{ old('deskripsi', $lapangan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga per Jam --}}
                <div>
                    <label for="harga_per_jam" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Harga per Jam (Rp) <span class="text-rose-500">*</span></label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-xs font-bold text-slate-400 uppercase">Rp</span>
                        </div>
                        <input type="number" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}" min="0" required 
                            placeholder="150000"
                            class="block w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('harga_per_jam') border-rose-300 bg-rose-50/20 @enderror">
                    </div>
                    @error('harga_per_jam')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fasilitas --}}
                <div>
                    <label for="fasilitas" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Fasilitas <span class="text-slate-400 font-normal">(Satu per baris)</span></label>
                    <textarea name="fasilitas" id="fasilitas" rows="4" 
                        placeholder="Contoh:&#10;Rumput Sintetis Premium&#10;Lampu LED Malam&#10;Tribun Penonton"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 shadow-sm bg-slate-50/50 text-sm font-semibold text-slate-700 placeholder-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all font-mono">{{ old('fasilitas', $lapangan->fasilitas ? implode("\n", $lapangan->fasilitas) : '') }}</textarea>
                    <p class="mt-2 text-[10px] text-slate-400 font-semibold">Tuliskan satu fasilitas per baris (tekan Enter untuk membuat baris baru).</p>
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Foto Lapangan</label>
                    
                    @if($lapangan->foto)
                        <div class="mb-4 p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl overflow-hidden border border-slate-200 shadow-sm shrink-0">
                                <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs font-extrabold text-slate-700">Foto Saat Ini</p>
                                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 truncate max-w-xs">{{ $lapangan->foto }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl hover:border-indigo-400 transition-colors bg-slate-50/30">
                        <div class="space-y-2 text-center">
                            <svg class="mx-auto h-10 w-10 text-slate-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none transition-colors">
                                    <span>Pilih File Baru</span>
                                    <input type="file" name="foto" id="foto" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1 text-slate-400 font-medium">atau tarik ke sini</p>
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold">Kosongkan jika tidak ingin mengubah foto. Maks. 2MB</p>
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status Operasional <span class="text-rose-500">*</span></label>
                    <select name="status" id="status" 
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                        <option value="aktif" {{ old('status', $lapangan->status) === 'aktif' ? 'selected' : '' }}>Aktif (Tersedia untuk disewa)</option>
                        <option value="nonaktif" {{ old('status', $lapangan->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Sedang Perbaikan / Tutup)</option>
                    </select>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.lapangan.index') }}" 
                    class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                    class="px-5 py-3 rounded-2xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-200 shadow-md shadow-indigo-600/10 hover:-translate-y-0.5">
                    Perbarui Lapangan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
