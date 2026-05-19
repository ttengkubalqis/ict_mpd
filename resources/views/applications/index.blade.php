@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header & Action Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Senarai Permohonan</h1>
            <p class="text-sm text-slate-500">Uruskan kelulusan dan rekod pinjaman aset kakitangan.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-blue-200 flex items-center gap-2 w-max">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Cipta Permohonan Baru
        </button>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
            <!-- Filter Status -->
            <select class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none min-w-[160px]">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu Kelulusan</option>
                <option value="lulus">Telah Diluluskan</option>
                <option value="ditolak">Ditolak</option>
                <option value="dipulangkan">Telah Dipulangkan</option>
            </select>
            
            <!-- Filter Jabatan -->
            <select class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none min-w-[160px]">
                <option value="">Semua Jabatan</option>
                <option value="jpb">Jabatan Perancang Bandar</option>
                <option value="ict">Unit ICT</option>
                <option value="kewangan">Jabatan Kewangan</option>
            </select>
        </div>

        <!-- Search Bar -->
        <div class="relative w-full md:w-80">
            <input type="text" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Cari ID permohonan atau nama...">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm">
                        <th class="px-6 py-4 font-medium">ID & Tarikh Mohon</th>
                        <th class="px-6 py-4 font-medium">Maklumat Peminjam</th>
                        <th class="px-6 py-4 font-medium">Aset Dipohon</th>
                        <th class="px-6 py-4 font-medium">Tempoh Pinjaman</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    
                    <!-- Row 1: Menunggu Kelulusan -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-blue-600">#PJ-202605</div>
                            <div class="text-xs text-slate-500">07 Mei 2026</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">Khairul Anuar</div>
                            <div class="text-xs text-slate-500">Jabatan Perancang Bandar</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">Projektor Epson EB-X41</td>
                        <td class="px-6 py-4">
                            <div class="text-slate-800">10 Mei - 12 Mei</div>
                            <div class="text-xs text-slate-500">3 Hari</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                Menunggu
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Butang Tindakan: Lulus & Tolak (Untuk Pending) -->
                            <button class="bg-emerald-50 text-emerald-600 hover:bg-emerald-100 p-2 rounded-lg transition-colors" title="Luluskan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                            <button class="bg-red-50 text-red-600 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Tolak">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <!-- Tukar kod butang Lihat Butiran ini: -->
                            <a href="{{ route('applications.show', ['id' => 'PJ-202605']) }}" class="inline-block text-slate-400 hover:text-blue-600 p-2 transition-colors align-middle" title="Lihat Butiran">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: Lulus -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-blue-600">#PJ-202602</div>
                            <div class="text-xs text-slate-500">01 Mei 2026</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">Siti Nurhaliza</div>
                            <div class="text-xs text-slate-500">Jabatan Perlesenan</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">Laptop Dell Latitude</td>
                        <td class="px-6 py-4">
                            <div class="text-slate-800">02 Mei - 15 Mei</div>
                            <div class="text-xs text-slate-500">14 Hari</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                Sedang Dipinjam
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Butang Pulang -->
                            <button class="text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors border border-blue-200" title="Pulangkan Aset">
                                Sahkan Pulang
                            </button>
                            <button class="text-slate-400 hover:text-blue-600 p-2 transition-colors align-middle" title="Lihat Butiran">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: Selesai / Dipulangkan -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-600">#PJ-202601</div>
                            <div class="text-xs text-slate-500">20 Apr 2026</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">Ahmad Farid</div>
                            <div class="text-xs text-slate-500">Bahagian Kejuruteraan</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">Tablet iPad Pro</td>
                        <td class="px-6 py-4">
                            <div class="text-slate-800">22 Apr - 24 Apr</div>
                            <div class="text-xs text-slate-500">3 Hari</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold border border-slate-200">
                                Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-slate-400 hover:text-blue-600 p-2 transition-colors" title="Lihat Rekod">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-white rounded-b-2xl">
            <span class="text-sm text-slate-500">Memaparkan 1 hingga 3 daripada 12 permohonan</span>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 border border-slate-200 text-slate-500 rounded-lg text-sm hover:bg-slate-50 transition-colors">Seterusnya</button>
                <button class="px-3 py-1.5 border border-slate-200 text-slate-500 rounded-lg text-sm hover:bg-slate-50 transition-colors">Sebelumnya</button>
            </div>
        </div>
    </div>

</div>
@endsection