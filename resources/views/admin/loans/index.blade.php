@extends('layouts.app') 

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Senarai Permohonan</h1>
            <p class="text-sm text-slate-500">Uruskan kelulusan dan rekod pinjaman aset kakitangan.</p>
        </div>
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Cipta Permohonan Baru
        </a>
    </div>

    <div class="bg-white p-4 rounded-t-2xl border-x border-t border-slate-100 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="flex gap-3 w-full md:w-auto">
            <select class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500">
                <option>Semua Status</option>
                <option>Menunggu</option>
                <option>Sedang Dipinjam</option>
                <option>Selesai</option>
            </select>
            <select class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-blue-500">
                <option>Semua Jabatan</option>
            </select>
        </div>
        <div class="relative w-full md:w-80 flex gap-2">
            <input type="text" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cari ID permohonan atau nama...">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-b-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-100 text-slate-500 text-sm">
                        <th class="px-6 py-4 font-medium">ID & Tarikh Mohon</th>
                        <th class="px-6 py-4 font-medium">Maklumat Peminjam</th>
                        <th class="px-6 py-4 font-medium">Aset Dipohon</th>
                        <th class="px-6 py-4 font-medium">Tempoh Pinjaman</th>
                        <th class="px-6 py-4 font-medium text-center">Status</th>
                        <th class="px-6 py-4 font-medium text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    
                    @forelse($loans as $loan)
                        @php
                            // Format ID menjadi #PJ-0001
                            $formatId = '#PJ-' . str_pad($loan->id, 4, '0', STR_PAD_LEFT);
                            // Kira bilangan hari pinjaman
                            $tarikhMula = \Carbon\Carbon::parse($loan->borrow_date);
                            $tarikhAkhir = \Carbon\Carbon::parse($loan->return_date);
                            $bilHari = $tarikhMula->diffInDays($tarikhAkhir) + 1; // +1 untuk kira hari pertama
                        @endphp
                        
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-blue-600">{{ $formatId }}</div>
                                <div class="text-xs text-slate-400 mt-1">{{ \Carbon\Carbon::parse($loan->created_at)->format('d M Y') }}</div>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">Ahmad Pemohon</div>
                                <div class="text-xs text-slate-500 mt-1 uppercase">{{ $loan->location }}</div>
                            </td>
                            
                            <td class="px-6 py-4 font-medium">
                                {{ $loan->quantity }} Unit {{ $loan->asset_type }}
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="text-slate-800">
                                    {{ $tarikhMula->format('d M') }} - {{ $tarikhAkhir->format('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-400 mt-1">{{ $bilHari }} Hari</div>
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($loan->status == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu Kelulusan
                                    </span>
                                @elseif($loan->status == 'approved' && is_null($loan->asset_id))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold border border-blue-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Menunggu Serahan
                                    </span>
                                @elseif($loan->status == 'approved' && !is_null($loan->asset_id))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Sedang Dipinjam
                                    </span>
                                @elseif($loan->status == 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-semibold border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold border border-slate-200">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.loans.show', $loan->id) }}" class="inline-block p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Lihat Butiran">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>Tiada rekod permohonan dijumpai.</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-white border-t border-slate-100">
            {{ $loans->links() }}
        </div>
    </div>

</div>
@endsection