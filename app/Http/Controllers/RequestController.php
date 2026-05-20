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
            'jenis_aset' => 'required|array',
            'kuantiti' => 'required|array',
        ]);

        $jenisAset = $request->jenis_aset;
        $kuantiti = $request->kuantiti;
        $adaAset = false;

        // 2. Loop melalui senarai aset yang ditambah secara dinamik
        for ($i = 0; $i < count($jenisAset); $i++) {
            
            // Pastikan jenis aset tidak kosong dan kuantiti lebih dari 0
            if (!empty($jenisAset[$i]) && $kuantiti[$i] > 0) {
                $adaAset = true;
                
                // Simpan ke dalam database
                AssetLoan::create([
                    // 'user_id' => auth()->id(), // Buka komen ini jika login berfungsi
                    'purpose' => $request->tujuan,
                    'location' => $request->tempat,
                    'borrow_date' => $request->tarikh_pinjam,
                    'return_date' => $request->tarikh_pulang,
                    'asset_type' => $jenisAset[$i],
                    'quantity' => $kuantiti[$i],
                    'status' => 'pending' // Status awal
                ]);
            }
        }

        // 3. Jika pengguna hantar borang tapi semua pilihan aset kosong
        if (!$adaAset) {
            return back()->withErrors(['Sila pilih sekurang-kurangnya satu jenis aset untuk dipinjam.']);
        }

        // 4. Kembali ke dashboard pemohon berserta mesej kejayaan
        return redirect()->route('pemohon.dashboard')->with('success', 'Permohonan pinjaman aset berjaya dihantar dan sedang diproses.');
    }
}