@extends('layouts.app') 

@section('content')
<div class="max-w-6xl mx-auto space-y-6"> 
    
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Butiran Permohonan</h1>
            <p class="text-sm text-slate-500">Semak dan uruskan proses pinjaman aset ini.</p>
        </div>
        <a href="{{ route('admin.loans.index') }}" class="text-sm text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> 
            Kembali ke Senarai
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Maklumat Peminjam</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Nama Pemohon</p>
                        <p class="font-semibold text-slate-800">Ahmad Pemohon</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">ID Permohonan</p>
                        <p class="font-semibold text-blue-600">#PJ-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Butiran Pinjaman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Aset Dipohon</p>
                        <p class="font-bold text-slate-800 text-lg">{{ $loan->quantity }} Unit {{ $loan->asset_type }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Tujuan Pinjaman</p>
                        <p class="font-semibold text-slate-800 mt-1">{{ $loan->purpose }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Tempat Digunakan</p>
                        <p class="font-semibold text-slate-800">{{ $loan->location }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Tempoh Masa</p>
                        <p class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }} hingga {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t border-slate-100">
                    <p class="text-slate-500 text-sm mb-2">Status Semasa</p>
                    @if($loan->status == 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-100">Menunggu Kelulusan</span>
                    @elseif($loan->status == 'approved' && is_null($loan->asset_id))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-bold border border-blue-100">Telah Diluluskan (Menunggu Serahan)</span>
                    @elseif($loan->status == 'approved' && !is_null($loan->asset_id))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100">Sedang Dipinjam</span>
                    @elseif($loan->status == 'returned')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">Telah Dipulangkan (Selesai)</span>
                    @endif
                </div>
            </div>
            
            @if(($loan->status == 'approved' || $loan->status == 'returned') && !is_null($loan->asset_id))
                @php
                    $assignedAsset = \App\Models\Asset::where('serial_number', $loan->asset_id)->first();
                @endphp
                
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Maklumat Aset Yang Dipinjam</h3>
                    @if($assignedAsset)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4 text-sm">
                            <div>
                                <p class="text-slate-500 mb-1">No. Siri Pendaftaran</p>
                                <p class="font-bold text-blue-700 text-lg">{{ $assignedAsset->serial_number }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 mb-1">Nama Aset / Model</p>
                                <p class="font-semibold text-slate-800">{{ $assignedAsset->name }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-6">
                @if($loan->status == 'approved' && !is_null($loan->asset_id))
                    <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-6 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500"></div>
                        <h3 class="text-lg font-bold text-emerald-800 mb-4 border-b border-slate-100 pb-2">Tindakan Penerima</h3>
                        
                        <form action="{{ route('admin.loans.pemulangan', $loan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Tarikh Dipulangkan</label>
                                <input type="date" name="returned_date" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500 text-sm" value="{{ date('Y-m-d') }}" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Status Fizikal Aset</label>
                                <select name="asset_condition" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
                                    <option value="">-- Nyatakan Keadaan --</option>
                                    <option value="Baik">Baik & Berfungsi</option>
                                    <option value="Rosak">Rosak / Perlu Penyelenggaraan</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Status Aksesori</label>
                                <select name="accessories_condition" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
                                    <option value="">-- Nyatakan Keadaan --</option>
                                    <option value="Lengkap">Lengkap Diterima</option>
                                    <option value="Tidak Lengkap">Tidak Lengkap / Sebahagian Hilang</option>
                                    <option value="Tiada">Tiada Aksesori Disertakan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Catatan Tambahan (Opsyenal)</label>
                                <textarea name="remarks" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Contoh: Calar di bahagian tepi skrin..."></textarea>
                            </div>

                            <button type="submit" class="w-full px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition-all mt-2">
                                Sahkan Pemulangan
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection