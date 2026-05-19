<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    // Papar halaman senarai aset (beserta fungsi filter & search)
    public function index(Request $request)
    {
        // Mulakan query kosong
        $query = Asset::query();

        // 1. Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        // 2. Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Fungsi Carian (Nama atau No Siri)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        // Dapatkan data terkini dan pastikan filter tidak hilang bila tukar muka surat (pagination)
        $assets = $query->latest()->paginate(10)->withQueryString();

        return view('assets.index', compact('assets'));
    }

    // Papar borang tambah aset
    public function create()
    {
        return view('assets.create');
    }

    // Proses simpan data ke database
    public function store(Request $request)
    {
        // 1. Pengesahan Data (Validation)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:assets,serial_number',
            'category' => 'required|string',
            'os_version' => 'nullable|string',
            'accessories' => 'nullable|array', // Pastikan ia diterima sebagai array
            'purchase_date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB mengikut UI
        ]);

        // 2. Pengurusan Muat Naik Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Gambar akan disimpan di dalam folder storage/app/public/assets_images
            $imagePath = $request->file('image')->store('assets_images', 'public');
        }

        // 3. Simpan Rekod ke Pangkalan Data
        Asset::create([
            // Gunakan strtoupper() untuk pastikan ia simpan huruf besar dalam database
            'name' => strtoupper($validated['name']),
            'serial_number' => strtoupper($validated['serial_number']),
            
            'category' => $validated['category'],
            'os_version' => $validated['os_version'],
            'accessories' => $validated['accessories'] ?? [], 
            'purchase_date' => $validated['purchase_date'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'status' => 'tersedia' 
        ]);

        // 4. Bawa pengguna kembali ke senarai aset beserta mesej kejayaan
        return redirect()->route('assets.index')->with('success', 'Aset baru berjaya didaftarkan ke dalam sistem!');
    }
    
    // Memaparkan borang edit dengan data sedia ada
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        return view('assets.edit', compact('asset'));
    }
    

// Memproses kemas kini data
    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan No Siri unik, abaikan ID aset semasa
            'serial_number' => 'required|string|max:255|unique:assets,serial_number,' . $asset->id,
            'category' => 'required|string',
            'os_version' => 'nullable|string',
            'accessories' => 'nullable|array',
            'purchase_date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB
        ]);

        // 1. Sediakan data asas untuk dikemas kini
        $updateData = [
            // Gunakan strtoupper() untuk paksa simpan huruf besar dalam database
            'name' => strtoupper($validated['name']),
            'serial_number' => strtoupper($validated['serial_number']),
            
            'category' => $validated['category'],
            'os_version' => $validated['os_version'],
            'accessories' => $validated['accessories'] ?? [],
            'purchase_date' => $validated['purchase_date'],
            'description' => $validated['description'],
        ];

        // 2. Pengurusan Gambar (Hanya proses jika admin muat naik fail baru)
        if ($request->hasFile('image')) {
            
            // Padam gambar lama dari 'storage' jika wujud
            if ($asset->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($asset->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($asset->image_path);
            }
            
            // Simpan gambar baru dan masukkan laluan (path) ke dalam array $updateData
            $updateData['image_path'] = $request->file('image')->store('assets_images', 'public');
        }

        // 3. Simpan semuanya ke dalam database serentak
        $asset->update($updateData);

        return redirect()->route('assets.index')->with('success', 'Maklumat dan gambar aset berjaya dikemas kini!');
    }

    // Memproses hapus data
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);

        // Semak dan padam gambar dari folder 'storage' jika wujud
        if ($asset->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($asset->image_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($asset->image_path);
        }

        // Padam rekod dari pangkalan data
        $asset->delete();

        // Kembali ke senarai beserta mesej
        return redirect()->route('assets.index')->with('success', 'Rekod aset berjaya dihapuskan dari sistem.');
    }
}