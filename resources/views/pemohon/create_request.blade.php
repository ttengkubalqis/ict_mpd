@extends('layouts.pemohon')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-2">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Permohonan Pinjaman Aset</h1>
            <p class="text-sm text-slate-500">Sila lengkapkan butiran mengikut borang KEW.PA-9.</p>
        </div>
        <div class="text-right">
            <span class="text-xs font-bold text-slate-400 border border-slate-200 px-2 py-1 rounded">KEW.PA-9</span>
        </div>
    </div>

    <form action="{{ route('pemohon.simpan') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">1</span>
                Maklumat Pemohon
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Nama Pemohon</label>
                    <input type="text" value="AHMAD PEMOHON" class="w-full bg-slate-50 border border-slate-200 text-slate-500 rounded-lg px-4 py-2.5 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Bahagian / Unit</label>
                    <input type="text" value="UNIT KEWANGAN" class="w-full bg-slate-50 border border-slate-200 text-slate-500 rounded-lg px-4 py-2.5 cursor-not-allowed" readonly>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">2</span>
                Butiran Pergerakan Aset
            </h3>

            <div class="space-y-6">
                <div class="w-full">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tujuan Pinjaman <span class="text-red-500">*</span></label>
                    <textarea name="tujuan" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Mesyuarat Penyelarasan ICT di Bilik Seminar" required></textarea>
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tempat Digunakan <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Bilik Mesyuarat Utama" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div>
                        <label class="block text-sm font-semibold text-blue-800 mb-1">Tarikh Dipinjam <span class="text-red-500">*</span></label>
                        <input type="date" name="tarikh_pinjam" class="w-full px-4 py-2.5 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-blue-800 mb-1">Jangka Pulang <span class="text-red-500">*</span></label>
                        <input type="date" name="tarikh_pulang" class="w-full px-4 py-2.5 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">3</span>
                Aset Yang Ingin Dipinjam
            </h3>
            
            <div class="overflow-hidden border border-slate-100 rounded-xl">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Pilih Aset</th>
                            <th class="px-4 py-3 font-semibold text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="px-4 py-3">
                                <select name="asset_id[]" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Sila Pilih Aset --</option>
                                    <option value="1">MPD-ICT-2024-001 | LAPTOP LENOVO T14</option>
                                    <option value="2">MPD-ICT-2024-005 | PROJEKTOR EPSON</option>
                                </select>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button type="button" class="text-slate-400 hover:text-red-500">
                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-3 bg-slate-50 border-t border-slate-100">
                    <button type="button" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        TAMBAH ASET LAIN
                    </button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pb-10">
            <a href="{{ route('pemohon.dashboard') }}" class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">Batal</a>
            <button type="submit" class="px-8 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md shadow-blue-200 transition-all">
                Hantar Permohonan
            </button>
        </div>
    </form>
</div>
@endsection