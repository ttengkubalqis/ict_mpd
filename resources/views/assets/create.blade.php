@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Daftar Aset Baru</h1>
            <p class="text-sm text-slate-500">Sila masukkan maklumat lengkap inventori ICT baharu.</p>
        </div>
        <a href="{{ route('assets.index') }}" class="text-sm text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Senarai
        </a>
    </div>

    <!-- Form Card -->
    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
        @csrf

            <!-- ========================================== -->
            <!-- Seksyen 1: Maklumat Asas & Spesifikasi Teknikal -->
            <!-- ========================================== -->
            <div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Maklumat & Spesifikasi Aset</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama/Model -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Aset / Model <span class="text-red-500">*</span></label>
                        <input type="text" name="name" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all uppercase" 
                           placeholder="CTH: LAPTOP LENOVO THINKPAD T14" 
                           oninput="this.value = this.value.toUpperCase()" 
                           required>
                    </div>

                    <!-- No Siri / Hak Milik -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">No. Siri / ID Pendaftaran <span class="text-red-500">*</span></label>
                        <input type="text" name="serial_number" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all uppercase" 
                           placeholder="CTH: MPD-ICT-2026-001" 
                           oninput="this.value = this.value.toUpperCase()" 
                           required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all bg-white" required>
                            <option value="">Pilih Kategori</option>
                            <option value="komputer">Komputer / PC</option>
                            <option value="laptop">Komputer Riba (Laptop)</option>
                            <option value="projektor">Projektor</option>
                            <option value="tablet">Tablet / Telefon Pintar</option>
                            <option value="aksesori">Lain-lain / Aksesori</option>
                        </select>
                    </div>

                    <!-- Jenis OS -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Sistem Operasi (OS)</label>
                        <select name="os_version" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all bg-white">
                            <option value="">Tiada / Tidak Berkenaan</option>
                            <option value="win11">Windows 11</option>
                            <option value="win10">Windows 10</option>
                            <option value="macos">macOS</option>
                            <option value="linux">Linux</option>
                            <option value="android">Android</option>
                            <option value="ios">iOS / iPadOS</option>
                        </select>
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika aset bukan komputer/peranti pintar.</p>
                    </div>

                    <!-- Aksesori (Modal UI) -->
                    <div class="col-span-1 md:col-span-2 bg-slate-50 p-5 rounded-xl border border-slate-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 gap-3">
                            <label class="block text-sm font-semibold text-slate-700">Aksesori Yang Disertakan Bersama Aset</label>
                            <button type="button" onclick="bukaModalAksesori()" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1.5 rounded-lg font-medium transition-colors flex items-center gap-1.5 w-max shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Aksesori Lain
                            </button>
                        </div>
                        <div id="senarai-aksesori-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="accessories[]" value="Tetikus (Mouse)" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Tetikus (Mouse)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="accessories[]" value="Pengecas (Adapter)" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Pengecas (Charger)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="accessories[]" value="Kabel Rangkaian" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Kabel Rangkaian</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="accessories[]" value="Kabel HDMI/VGA" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">HDMI/VGA (Adapter)</span>
                            </label>
                        </div>
                    </div>
                </div> <!-- // PENUTUP GRID SEKSYEN 1 (SANGAT PENTING!) -->
            </div> <!-- // PENUTUP SEKSYEN 1 -->

            <!-- ========================================== -->
            <!-- Seksyen 2: Maklumat Perolehan & Catatan -->
            <!-- ========================================== -->
            <!-- Ini duduk dalam bloknya sendiri, maka ia turun ke bawah -->
            <div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Perolehan & Catatan</h3>
                <!-- Grid 1 baris, 2 lajur untuk Tarikh dan Catatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tarikh Perolehan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tarikh Perolehan / Penerimaan</label>
                        <input type="date" name="purchase_date" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <!-- Catatan Tambahan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Tambahan</label>
                        <textarea name="description" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Cth: Ditempatkan sementara di Bilik Server. Processor Intel i7, RAM 16GB."></textarea>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- Seksyen 3: Gambar Aset -->
            <!-- ========================================== -->
            <div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Gambar Aset (Pilihan)</h3>
                <div class="mt-2 flex justify-center rounded-xl border border-dashed border-slate-300 px-6 py-10 hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm leading-6 text-slate-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                <span>Muat naik fail</span>
                                <input id="file-upload" name="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">atau seret dan lepas di sini</p>
                        </div>
                        <p class="text-xs leading-5 text-slate-500">PNG, JPG, GIF sehingga 2MB</p>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- Form Actions -->
            <!-- ========================================== -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('assets.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm shadow-blue-200">
                    Simpan Aset
                </button>
            </div>
        </form>
    </div>

</div>
@endsection