<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Amikom Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-cyan-100 p-8 font-sans min-h-screen flex flex-col items-center">

    <nav class="flex flex-wrap gap-4 mb-10 justify-center w-full max-w-4xl">
        <a href="/" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-md transition">Home</a>
        <a href="/tentang" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Tentang</a>
        <a href="/profil" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Profil</a>
        <a href="/katalog" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Katalog</a>
        <a href="/bantuan" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Bantuan</a>
        <a href="/kontak" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Kontak</a>
    </nav>

    <div class="max-w-4xl w-full bg-white/90 backdrop-blur-lg p-12 rounded-3xl shadow-xl border border-white/50 text-center">
        <div class="mb-6 inline-block p-5 bg-indigo-50 rounded-full shadow-inner">
            <span class="text-6xl">🎓</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-800 mb-4">Selamat Datang di <br><span class="text-indigo-600">Amikom Event Hub</span></h1>
        <p class="text-slate-500 mb-10 text-lg">Platform informasi dan pendaftaran event mahasiswa terpadu.</p>
        
        <div class="bg-slate-50/80 p-8 rounded-2xl border border-slate-100 flex flex-col md:flex-row items-center justify-around gap-6 shadow-sm">
            <div>
                <p class="text-sm text-slate-400 font-semibold uppercase tracking-wider">Dikembangkan Oleh</p>
                <p class="text-2xl font-bold text-indigo-900 mt-2">{{ $nama }}</p>
            </div>
            <div class="hidden md:block w-px h-20 bg-slate-200"></div>
            <div>
                <p class="text-sm text-slate-400 font-semibold uppercase tracking-wider">NIM Mahasiswa</p>
                <p class="text-2xl font-bold text-indigo-900 mt-2">{{ $nim }}</p>
            </div>
        </div>
    </div>
//
</body>
</html>
//