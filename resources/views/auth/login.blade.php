<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk - Modul Pinjaman Aset ICT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="text-center mb-8">
            <div class="bg-blue-600 text-white w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Sistem e-Aset</h2>
            <p class="text-sm text-slate-500 mt-1">Log masuk ke akaun anda</p>
        </div>

        <form method="GET" action="{{ route('dashboard') }}" class="space-y-5">
            <!-- CSRF Token For Laravel -->
            <!-- @csrf -->
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">E-mel Rasmi</label>
                <input type="email" name="email" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="admin@domain.com" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kata Laluan</label>
                <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-slate-600">Ingat Saya</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lupa Kata Laluan?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors shadow-lg shadow-blue-200">
                Log Masuk
            </button>
        </form>
    </div>

</body>
</html>