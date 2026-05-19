@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header & Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('applications.index') }}" class="hover:text-blue-600 transition-colors">Permohonan</a>
                <span>/</span>
                <span class="text-slate-700 font-medium">Butiran</span>
            </div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-slate-800">Permohonan #{{ $id }}</h1>
                <!-- Status Badge -->
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold border border-amber-200 mt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                    Menunggu Kelulusan
                </span>
            </div>
        </div>
        
        <!-- Action Buttons (Top) -->
        <div class="flex items-center gap-3">
            <button class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors border border-red-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Tolak
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-blue-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Luluskan
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column (Maklumat Pemohon & Pinjaman) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card 1: Maklumat Pemohon -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Maklumat Kakitangan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Nama Penuh</p>
                        <p class="font-medium text-slate-900">Khairul Anuar bin Mamat</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Jabatan / Bahagian</p>
                        <p class="font-medium text-slate-900">Jabatan Perancang Bandar</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 mb-1">E-mel Rasmi</p>
                        <p class="font-medium text-slate-900">khairul.anuar@domain.gov.my</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 mb-1">No. Telefon</p>
                        <p class="font-medium text-slate-900">012-345 6789</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Butiran Pinjaman -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Butiran Penggunaan Aset
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Tarikh Ambil</p>
                        <p class="font-semibold text-slate-800">10 Mei 2026</p>
                        <p class="text-xs text-slate-500 mt-1">Isnin, 8:00 Pagi</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Tarikh Pulang</p>
                        <p class="font-semibold text-slate-800">12 Mei 2026</p>
                        <p class="text-xs text-slate-500 mt-1">Rabu, 5:00 Petang</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex flex-col justify-center items-center text-center">
                        <p class="text-xs text-blue-600 mb-1 font-medium">Tempoh</p>
                        <p class="text-2xl font-bold text-blue-700">3</p>
                        <p class="text-xs text-blue-600 font-medium">Hari</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Tujuan / Justifikasi Pinjaman</p>
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 text-sm text-slate-700">
                        Memerlukan projektor untuk pembentangan Kertas Kerja Pelan Induk Bandar Pintar bersama Ahli Majlis di Bilik Gerakan Utama.
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column (Maklumat Aset & Log) -->
        <div class="space-y-6">
            
            <!-- Card 3: Aset Dipohon -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden">
                <!-- Hiasan latar belakang -->
                <div class="absolute -right-6 -top-6 text-slate-50 opacity-50">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                
                <h3 class="text-lg font-semibold text-slate-800 mb-4 relative z-10 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Aset Diminta
                </h3>
                
                <div class="relative z-10">
                    <!-- Imej Placeholder (Pilihan) -->
                    <div class="w-full h-32 bg-slate-100 rounded-xl mb-4 border border-slate-200 flex items-center justify-center overflow-hidden">
                        <img src="https://via.placeholder.com/400x300?text=Imej+Projektor" alt="Gambar Aset" class="w-full h-full object-cover opacity-80">
                    </div>
                    
                    <p class="font-bold text-slate-900 text-lg">Projektor Epson EB-X41</p>
                    <p class="text-sm text-slate-500 mb-4">Projektor Mudah Alih (ICT-PR-023)</p>
                    
                    <div class="space-y-2 pt-4 border-t border-slate-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Status Semasa Aset:</span>
                            <span class="font-medium text-emerald-600">Tersedia Dalam Stor</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Lokasi:</span>
                            <span class="font-medium text-slate-800">Rak A, Bilik Server ICT</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Ruangan Catatan Pentadbir (Form kelulusan) -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-sm font-semibold text-slate-800 mb-3">Tindakan Kelulusan</h3>
                <form action="#" method="POST">
                    @csrf
                    <textarea name="admin_remarks" rows="3" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all mb-3" placeholder="Sila berikan catatan tambahan jika permohonan ditolak atau diluluskan bersyarat..."></textarea>
                    
                    <button type="button" class="w-full bg-slate-50 hover:bg-slate-100 text-slate-700 py-2 rounded-lg text-sm font-medium transition-colors border border-slate-200 flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Borang Permohonan
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection