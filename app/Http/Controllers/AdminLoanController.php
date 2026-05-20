<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetLoan;
use Carbon\Carbon;

class AdminLoanController extends Controller
{
    public function index()
    {
        // Tarik semua data permohonan, susun yang terbaru di atas
        $loans = AssetLoan::latest()->paginate(10);
        
        return view('admin.loans.index', compact('loans'));
    }

    // 1. Memaparkan halaman butiran
    public function show($id)
    {
        $loan = AssetLoan::findOrFail($id);
        $availableAssets = collect(); // Kosongkan secara lalai

        // Jika status telah LULUS tapi Pengeluar belum serah aset, baru kita tarik data inventori
        if ($loan->status == 'approved' && is_null($loan->asset_id)) {
            $availableAssets = \App\Models\Asset::where('status', 'tersedia')
                ->where('category', strtolower($loan->asset_type))
                ->get();

            if ($availableAssets->isEmpty()) {
                $availableAssets = \App\Models\Asset::where('status', 'tersedia')->get();
            }
        }

        return view('admin.loans.show', compact('loan', 'availableAssets'));
    }

    // 2. Fungsi (Sedia ada) untuk Meluluskan/Menolak
    public function update(Request $request, $id)
    {
        $loan = AssetLoan::findOrFail($id);
        $request->validate(['status' => 'required|in:approved,rejected']);
        $loan->update(['status' => $request->status]);

        $mesej = $request->status == 'approved' ? 'Permohonan diluluskan! Sila ke langkah Serahan Aset.' : 'Permohonan ditolak.';
        return redirect()->back()->with('success', $mesej);
    }

    // 3. Fungsi BAHARU untuk Pengeluar merekodkan penyerahan aset fizikal
    public function updatePengeluaran(Request $request, $id)
    {
        $loan = AssetLoan::findOrFail($id);

        $request->validate([
            'asset_id' => 'required',
            'collection_date' => 'required|date',
            'collection_time' => 'required',
        ]);

        $loan->update([
            'asset_id' => $request->asset_id,
            'collection_date' => $request->collection_date,
            'collection_time' => $request->collection_time,
        ]);

        // Tukar status aset fizikal di inventori kepada 'dipinjam'
        $asset = \App\Models\Asset::where('serial_number', $request->asset_id)->first();
        if ($asset) {
            $asset->update(['status' => 'dipinjam']);
        }

        return redirect()->route('admin.loans.show', $loan->id)->with('success', 'Aset berjaya direkodkan untuk serahan!');
    }
    
    // Fungsi BAHARU untuk Admin sahkan penerimaan aset yang dipulangkan
    public function updatePemulangan(Request $request, $id)
    {
        $loan = AssetLoan::findOrFail($id);

        $request->validate([
            'returned_date' => 'required|date',
            'asset_condition' => 'required|string',
            'accessories_condition' => 'required|string',
            'remarks' => 'nullable|string', // Tambah validasi ini
        ]);

        // 1. Tukar status dan SIMPAN CATATAN
        $loan->update([
            'status' => 'returned',
            'remarks' => $request->remarks, // <--- Tambah baris ini
        ]);

        // 2. Automatik kemas kini status aset fizikal di inventori
        $asset = \App\Models\Asset::where('serial_number', $loan->asset_id)->first();
        if ($asset) {
            if ($request->asset_condition == 'Rosak' || $request->asset_condition == 'Hilang') {
                $asset->update(['status' => 'rosak']); 
            } else {
                $asset->update(['status' => 'tersedia']); 
            }
        }

        return redirect()->route('admin.loans.show', $loan->id)->with('success', 'Aset telah berjaya dipulangkan!');
    }
}