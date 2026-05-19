@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Papan Pemuka</h1>
            <p class="text-sm text-slate-500">Ringkasan status pinjaman aset terkini.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center gap-2 w-max">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Daftar Aset Baru
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Jumlah Aset</p>
                <p class="text-2xl font-bold text-slate-800">1,245</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="bg-amber-50 text-amber-600 p-4 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Sedang Dipinjam</p>
                <p class="text-2xl font-bold text-slate-800">42</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Permohonan Baru</p>
                <p class="text-2xl font-bold text-slate-800">8</p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-slate-800">Permohonan Terkini</h3>
            <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-sm">
                        <th class="px-6 py-4 font-medium">ID Pinjaman</th>
                        <th class="px-6 py-4 font-medium">Nama Peminjam</th>
                        <th class="px-6 py-4 font-medium">Aset</th>
                        <th class="px-6 py-4 font-medium">Tarikh</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-blue-600">#PJ-202601</td>
                        <td class="px-6 py-4">Ahmad Faizal (Bahagian Kejuruteraan)</td>
                        <td class="px-6 py-4">Projector Acer X1</td>
                        <td class="px-6 py-4">12 Mei 2026</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">Menunggu Kelulusan</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-blue-600">#PJ-202602</td>
                        <td class="px-6 py-4">Nurul Huda (Jabatan Perancang Bandar)</td>
                        <td class="px-6 py-4">Laptop Lenovo ThinkPad</td>
                        <td class="px-6 py-4">10 Mei 2026</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">Lulus</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection