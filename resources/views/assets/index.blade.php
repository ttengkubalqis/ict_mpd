@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Senarai Aset ICT</h1>
            <p class="text-sm text-slate-500">Urus dan pantau semua inventori aset dari sini.</p>
        </div>
        
        <a href="{{ route('assets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-blue-200 flex items-center gap-2 w-max cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Aset Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('assets.index') }}" method="GET" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            <select name="kategori" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none min-w-[150px]">
                <option value="">Semua Kategori</option>
                <option value="komputer" {{ request('kategori') == 'komputer' ? 'selected' : '' }}>Komputer / PC</option>
                <option value="laptop" {{ request('kategori') == 'laptop' ? 'selected' : '' }}>Komputer Riba</option>
                <option value="projektor" {{ request('kategori') == 'projektor' ? 'selected' : '' }}>Projektor</option>
                <option value="tablet" {{ request('kategori') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                <option value="aksesori" {{ request('kategori') == 'aksesori' ? 'selected' : '' }}>Aksesori</option>
            </select>
            
            <select name="status" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none min-w-[150px]">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="rosak" {{ request('status') == 'rosak' ? 'selected' : '' }}>Rosak / Penyelenggaraan</option>
            </select>
        </div>

        <div class="relative w-full md:w-80 flex gap-2">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Cari siri aset atau nama...">
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors border border-slate-200">
                Cari
            </button>
            
            @if(request('kategori') || request('status') || request('search'))
                <a href="{{ route('assets.index') }}" class="bg-red-50 hover:bg-red-100 text-red-500 px-3 py-2.5 rounded-lg transition-colors border border-red-100" title="Kosongkan Tapisan">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm">
                                <th class="px-6 py-4 font-medium">No. Siri / ID</th>
                                <th class="px-6 py-4 font-medium">Gambar</th> 
                                <th class="px-6 py-4 font-medium">Model & Nama Aset</th>
                                <th class="px-6 py-4 font-medium">Kategori</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                                <th class="px-6 py-4 font-medium text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            
                            @forelse($assets as $asset)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $asset->serial_number }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="w-16 h-16">
                                            @if($asset->image_path)
                                                <img src="{{ asset('storage/' . $asset->image_path) }}" alt="Gambar Aset" class="w-full h-full rounded-lg object-cover border border-slate-200 shadow-sm">
                                            @else
                                                <div class="w-full h-full rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400" title="Tiada Gambar Dimuat Naik">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900">{{ $asset->name }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5">
                                            {{ $asset->os_version === 'Tiada / Tidak Berkenaan' || empty($asset->os_version) ? 'Tiada OS' : ucwords(str_replace('-', ' ', $asset->os_version)) }}
                                            
                                            @if(!empty($asset->accessories) && is_array($asset->accessories))
                                                <span class="text-slate-300 mx-1">|</span>
                                                {{ count($asset->accessories) }} Aksesori
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 capitalize">{{ $asset->category }}</td>
                                    
                                    <td class="px-6 py-4">
                                        @if($asset->status == 'tersedia')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Tersedia
                                            </span>
                                        @elseif($asset->status == 'dipinjam')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Penyelenggaraan
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('assets.edit', $asset->id) }}" class="inline-block text-slate-400 hover:text-blue-600 transition-colors" title="Kemaskini">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Adakah anda pasti mahu menghapus aset {{ $asset->serial_number }} ini? Tindakan ini tidak boleh dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-slate-500 font-medium">Tiada rekod aset ditemui.</p>
                                        <p class="text-sm text-slate-400 mt-1">Sila klik "Tambah Aset Baru" untuk mendaftar inventori.</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
        </div>
        
        <div class="px-6 py-4 border-t border-slate-100 bg-white rounded-b-2xl">
            {{ $assets->links() }}
        </div>
    </div>

</div>
@endsection