<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetLoan; // Pastikan model ini dipanggil

class RequestController extends Controller
{
    public function create()
    {
        return view('pemohon.create_request');
    }

    public function store(Request $request)
    {
        // 1. Validasi input borang
        $request->validate([
            'tujuan' => 'required|string',
            'tempat' => 'required|string',
            'tarikh_pinjam' => 'required|date',
            'tarikh_pulang' => 'required|date|after_or_equal:tarikh_pinjam',
            'asset_id' => 'required|array',
        ]);

        // 2. Tapis (filter) sekiranya ada pilihan aset yang kosong ("-- Sila Pilih Aset --")
        $assets = array_filter($request->asset_id); 

        // Jika tiada aset langsung yang dipilih, patah balik beserta ralat
        if(empty($assets)) {
            return back()->withErrors(['Sila pilih sekurang-kurangnya satu aset untuk dipinjam.']);
        }

        // 3. Simpan setiap aset yang dipilih ke dalam pangkalan data
        foreach ($assets as $id) {
            AssetLoan::create([
                // 'user_id' => auth()->id(), // Buka komen ini jika sistem login (Auth) sudah berfungsi
                'asset_id' => $id,
                'purpose' => $request->tujuan,
                'location' => $request->tempat,
                'borrow_date' => $request->tarikh_pinjam,
                'return_date' => $request->tarikh_pulang,
                'status' => 'pending' // Status awal: Menunggu Kelulusan
            ]);
        }

        // 4. Kembali ke dashboard pemohon berserta mesej kejayaan
        return redirect()->route('pemohon.dashboard')->with('success', 'Permohonan pinjaman aset berjaya dihantar dan sedang diproses.');
    }
}