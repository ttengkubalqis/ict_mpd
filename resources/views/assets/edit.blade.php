@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kemaskini Aset</h1>
            <p class="text-sm text-slate-500">Kemas kini maklumat inventori ICT - {{ $asset->serial_number }}.</p>
        </div>
        <a href="{{ route('assets.index') }}" class="text-sm text-slate-500 hover:text-blue-600 flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> 
            Kembali ke Senarai
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="w-full">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Maklumat & Spesifikasi Aset</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Aset / Model <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $asset->name) }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all uppercase" 
                            oninput="this.value = this.value.toUpperCase()" 
                            required>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">No. Siri / ID Pendaftaran <span class="text-red-500">*</span></label>
                        <input type="text" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all uppercase" 
                            oninput="this.value = this.value.toUpperCase()" 
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500" required>
                            <option value="komputer" {{ old('category', $asset->category) == 'komputer' ? 'selected' : '' }}>Komputer / PC</option>
                            <option value="laptop" {{ old('category', $asset->category) == 'laptop' ? 'selected' : '' }}>Komputer Riba</option>
                            <option value="projektor" {{ old('category', $asset->category) == 'projektor' ? 'selected' : '' }}>Projektor</option>
                            <option value="tablet" {{ old('category', $asset->category) == 'tablet' ? 'selected' : '' }}>Tablet / Telefon Pintar</option>
                            <option value="aksesori" {{ old('category', $asset->category) == 'aksesori' ? 'selected' : '' }}>Lain-lain / Aksesori</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Sistem Operasi (OS)</label>
                        <select name="os_version" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500">
                            <option value="">Tiada / Tidak Berkenaan</option>
                            <option value="win11" {{ old('os_version', $asset->os_version) == 'win11' ? 'selected' : '' }}>Windows 11</option>
                            <option value="win10" {{ old('os_version', $asset->os_version) == 'win10' ? 'selected' : '' }}>Windows 10</option>
                            <option value="macos" {{ old('os_version', $asset->os_version) == 'macos' ? 'selected' : '' }}>macOS</option>
                            <option value="android" {{ old('os_version', $asset->os_version) == 'android' ? 'selected' : '' }}>Android</option>
                            <option value="ios" {{ old('os_version', $asset->os_version) == 'ios' ? 'selected' : '' }}>iOS / iPadOS</option>
                        </select>
                    </div>

                    @php 
                        $currentAccs = old('accessories', $asset->accessories ?? []); 
                        $standardAccs = ['Tetikus (Mouse)', 'Pengecas (Adapter)', 'Kabel Rangkaian', 'Kabel HDMI/VGA'];
                    @endphp
                    <div class="col-span-1 md:col-span-2 bg-slate-50 p-5 rounded-xl border border-slate-100">
                        <label class="block text-sm font-semibold text-slate-700 mb-4">Aksesori Yang Disertakan</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($standardAccs as $std)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="accessories[]" value="{{ $std }}" {{ in_array($std, $currentAccs) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">{{ $std }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Perolehan & Catatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tarikh Perolehan</label>
                        <input type="date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date ? \Carbon\Carbon::parse($asset->purchase_date)->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Tambahan</label>
                        <textarea name="description" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500">{{ old('description', $asset->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Gambar Aset (Pilihan)</h3>
                
                @if($asset->image_path)
                    <div class="mb-4 p-4 bg-slate-50 rounded-xl border border-slate-100 flex items-start gap-4">
                        <img src="{{ asset('storage/' . $asset->image_path) }}" alt="Gambar Aset" class="h-24 w-32 object-cover rounded-lg border border-slate-200 shadow-sm">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Gambar Semasa</p>
                            <p class="text-xs text-slate-500 mt-1">Muat naik fail baharu di bawah jika anda mahu menggantikan gambar ini.</p>
                        </div>
                    </div>
                @endif

                <div class="mt-2 flex justify-center rounded-xl border border-dashed border-slate-300 px-6 py-10 hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm leading-6 text-slate-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                <span>Muat naik fail baharu</span>
                                <input id="file-upload" name="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">atau seret dan lepas di sini</p>
                        </div>
                        <p class="text-xs leading-5 text-slate-500">PNG, JPG, GIF sehingga 2MB. Biarkan kosong jika tidak mahu menukar gambar.</p>
                    </div>
                </div>
            </div>

            <div class="w-full pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('assets.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm shadow-blue-200">
                    Kemaskini Aset
                </button>
            </div>
            
        </form>
    </div>
</div>

<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var labelSpan = this.previousElementSibling; 
        
        if(fileName) {
            labelSpan.textContent = fileName;
            labelSpan.classList.remove('text-blue-600');
            labelSpan.classList.add('text-emerald-600'); 
        }
    });
</script>
@endsection