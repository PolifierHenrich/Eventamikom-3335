<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-5xl mx-auto">
        <nav class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 p-3 flex justify-center gap-2 md:gap-4">
            <a href="/" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition font-medium">Home</a>
            <a href="/profil" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition font-medium">Profil</a>
            <a href="/katalog" class="px-5 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 font-semibold transition">Katalog</a>
            <a href="/bantuan" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition font-medium">Bantuan</a>
        </nav>

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-slate-900">Katalog Event</h1>
            <p class="text-slate-500 mt-2">Pilih dan ikuti event menarik di kampus.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="h-32 bg-blue-100 rounded-xl mb-4 flex items-center justify-center">
                    <span class="text-blue-500 font-semibold">💻 Workshop IT</span>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Laravel Dasar</h2>
                <p class="text-sm text-slate-500 mt-1">12 Mei 2026 • 09:00 WIB</p>
                <p class="text-slate-600 mt-3 text-sm">Belajar membuat website dari nol menggunakan framework PHP terpopuler.</p>
                <button class="mt-4 w-full bg-indigo-600 text-white font-medium py-2 rounded-xl hover:bg-indigo-700 transition">Daftar Sekarang</button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="h-32 bg-purple-100 rounded-xl mb-4 flex items-center justify-center">
                    <span class="text-purple-500 font-semibold">🎨 Seminar Desain</span>
                </div>
                <h2 class="text-xl font-bold text-slate-900">UI/UX dengan Figma</h2>
                <p class="text-sm text-slate-500 mt-1">15 Mei 2026 • 13:00 WIB</p>
                <p class="text-slate-600 mt-3 text-sm">Tingkatkan skill desain antarmuka untuk pemula.</p>
                <button class="mt-4 w-full bg-indigo-600 text-white font-medium py-2 rounded-xl hover:bg-indigo-700 transition">Daftar Sekarang</button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="h-32 bg-emerald-100 rounded-xl mb-4 flex items-center justify-center">
                    <span class="text-emerald-500 font-semibold">🚀 Kompetisi</span>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Hackathon Amikom</h2>
                <p class="text-sm text-slate-500 mt-1">20 Mei 2026 • 08:00 WIB</p>
                <p class="text-slate-600 mt-3 text-sm">Adu skill programming dalam 24 jam dan menangkan hadiah.</p>
                <button class="mt-4 w-full border border-slate-300 text-slate-700 font-medium py-2 rounded-xl hover:bg-slate-50 transition">Lihat Detail</button>
            </div>
        </div>
    </div>

</body>
</html>