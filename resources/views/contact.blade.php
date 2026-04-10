<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Amikom Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-cyan-100 p-8 font-sans min-h-screen flex flex-col items-center">

    <nav class="flex flex-wrap gap-4 mb-10 justify-center w-full max-w-4xl">
        <a href="/" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Home</a>
        <a href="/tentang" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Tentang</a>
        <a href="/profil" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Profil</a>
        <a href="/katalog" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Katalog</a>
        <a href="/bantuan" class="px-6 py-2.5 bg-white/80 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-sm hover:bg-white transition border border-indigo-100">Bantuan</a>
        <a href="/kontak" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-md transition">Kontak</a>
    </nav>

    <div class="max-w-4xl w-full bg-white/90 backdrop-blur-lg p-12 rounded-3xl shadow-xl border border-white/50 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4">Hubungi Kami</h1>
        <p class="text-slate-500 mb-10 text-xl">Punya pertanyaan lebih lanjut? Jangan ragu menyapa kami.</p>
        
        <div class="flex flex-col gap-6 max-w-xl mx-auto text-left">
            <div class="bg-white shadow-sm p-6 rounded-2xl flex items-center gap-6 border border-slate-100 hover:border-indigo-300 hover:shadow-md transition group">
                <div class="bg-gradient-to-br from-indigo-100 to-blue-50 text-indigo-600 w-16 h-16 flex items-center justify-center rounded-2xl text-3xl group-hover:scale-110 transition duration-300">📧</div>
                <div>
                    <p class="text-sm text-slate-400 font-semibold uppercase tracking-wider">Alamat Email</p>
                    <p class="text-xl font-bold text-indigo-900 mt-1">support@amikomevent.id</p>
                </div>
            </div>

            <div class="bg-white shadow-sm p-6 rounded-2xl flex items-center gap-6 border border-slate-100 hover:border-indigo-300 hover:shadow-md transition group">
                <div class="bg-gradient-to-br from-green-100 to-emerald-50 text-emerald-600 w-16 h-16 flex items-center justify-center rounded-2xl text-3xl group-hover:scale-110 transition duration-300">💬</div>
                <div>
                    <p class="text-sm text-slate-400 font-semibold uppercase tracking-wider">WhatsApp Bantuan</p>
                    <p class="text-xl font-bold text-indigo-900 mt-1">+62 895-3939-4424</p>
                </div>
            </div>
        </div>
    </div>
//
</body>
</html>