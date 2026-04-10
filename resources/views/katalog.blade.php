<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Amikom Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-cyan-100 p-8 font-sans min-h-screen flex flex-col items-center">

    <nav class="flex flex-wrap gap-4 mb-10 justify-center w-full max-w-4xl">
        <a href="/" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Home</a>
        <a href="/tentang" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Tentang</a>
        <a href="/profil" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Profil</a>
        <a href="/katalog" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-md transition">Katalog</a>
        <a href="/bantuan" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Bantuan</a>
        <a href="/kontak" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Kontak</a>
    </nav>

    <div class="max-w-4xl w-full bg-white/90 backdrop-blur-lg p-12 rounded-3xl shadow-xl border border-white/50 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-10">Katalog Event</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm hover:shadow-lg transition border border-slate-100 group">
                <div class="h-40 bg-gradient-to-r from-indigo-100 to-blue-50 rounded-xl mb-6 flex items-center justify-center group-hover:from-indigo-200 group-hover:to-blue-100 transition">
                    <span class="text-indigo-500 font-medium text-lg">Gambar Event 1</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">Seminar Teknologi Web</h2>
                <p class="text-slate-500 mt-3 text-base leading-relaxed">Pahami dasar Laravel dan Tailwind CSS untuk masa depan karir web developer.</p>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm hover:shadow-lg transition border border-slate-100 group">
                <div class="h-40 bg-gradient-to-r from-purple-100 to-pink-50 rounded-xl mb-6 flex items-center justify-center group-hover:from-purple-200 group-hover:to-pink-100 transition">
                    <span class="text-purple-500 font-medium text-lg">Gambar Event 2</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">Workshop UI/UX</h2>
                <p class="text-slate-500 mt-3 text-base leading-relaxed">Belajar membuat antarmuka yang user-friendly menggunakan platform Figma.</p>
            </div>
        </div>
    </div>
//
</body>
</html>
//