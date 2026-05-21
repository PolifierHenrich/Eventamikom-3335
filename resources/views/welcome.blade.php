<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Amikom Event Hub</title>
    <meta name="description" content="Platform informasi dan pendaftaran event mahasiswa terpadu - AmikomEventHub">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-8px); } }
        .float-anim { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-cyan-50 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white/80 backdrop-blur-lg border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-sm">AH</div>
                <span class="font-black text-slate-800 text-lg">AmikomEventHub</span>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="/" class="px-5 py-2 bg-indigo-600 text-white font-bold rounded-xl text-sm transition hover:bg-indigo-700">Home</a>
                <a href="/tentang" class="px-5 py-2 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-100 transition">Tentang</a>
                <a href="/profil" class="px-5 py-2 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-100 transition">Profil</a>
                <a href="/katalog" class="px-5 py-2 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-100 transition">Katalog</a>
                <a href="/bantuan" class="px-5 py-2 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-100 transition">Bantuan</a>
                <a href="/kontak" class="px-5 py-2 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-100 transition">Kontak</a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="max-w-6xl mx-auto px-6 py-20 text-center">
        <div class="float-anim inline-block mb-6">
            <span class="text-7xl">🎓</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-slate-800 mb-5 leading-tight">
            Selamat Datang di <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-cyan-500">Amikom Event Hub</span>
        </h1>
        <p class="text-slate-500 text-xl mb-10">Platform informasi dan pendaftaran event mahasiswa terpadu.</p>

        <div class="bg-white/90 backdrop-blur-lg p-8 rounded-3xl shadow-xl border border-white/60 max-w-lg mx-auto flex flex-col sm:flex-row items-center justify-around gap-6">
            <div class="text-center">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Dikembangkan Oleh</p>
                <p class="text-2xl font-black text-indigo-900 mt-2">{{ $nama }}</p>
            </div>
            <div class="hidden sm:block w-px h-16 bg-slate-200"></div>
            <div class="text-center">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">NIM Mahasiswa</p>
                <p class="text-2xl font-black text-indigo-900 mt-2">{{ $nim }}</p>
            </div>
        </div>
    </section>

    {{-- ====== SOAL 4: Kategori Section ====== --}}
    @if($categories->count() > 0)
    <section class="max-w-6xl mx-auto px-6 pb-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-slate-800">Kategori di AmikomEventHub</h2>
            <p class="text-slate-500 mt-2">Temukan event berdasarkan kategori favoritmu.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
            <div class="bg-white rounded-2xl p-5 text-center border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 cursor-pointer">
                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-2xl mx-auto mb-3">🏷️</div>
                <p class="font-black text-slate-800 text-sm">{{ $category->name }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ====== SOAL 4: Partner Section ====== --}}
    <section class="max-w-6xl mx-auto px-6 pb-20">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-slate-800">Partner Kami</h2>
            <p class="text-slate-500 mt-2">Didukung oleh berbagai mitra terpercaya.</p>
        </div>

        @if($partners->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach($partners as $partner)
            <div class="bg-white rounded-2xl p-6 flex flex-col items-center justify-center border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300 gap-3">
                @if($partner->logo_url)
                    <img src="{{ asset('storage/' . $partner->logo_url) }}"
                         alt="{{ $partner->name }}"
                         class="h-14 object-contain"
                         onerror="this.style.display='none'">
                @else
                    <div class="w-14 h-14 rounded-xl bg-indigo-50 flex items-center justify-center text-3xl">🤝</div>
                @endif
                <p class="font-black text-slate-700 text-sm text-center">{{ $partner->name }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-4xl mb-4">🤝</p>
            <p class="text-slate-500 font-medium">Belum ada partner yang terdaftar.</p>
            <p class="text-slate-400 text-sm mt-1">Partner dapat ditambahkan melalui panel Admin.</p>
        </div>
        @endif
    </section>

    {{-- Footer --}}
    <footer class="bg-indigo-900 text-indigo-200 py-8 text-center text-sm">
        <p class="font-bold text-white mb-1">AmikomEventHub &copy; {{ date('Y') }}</p>
        <p>Universitas Amikom Yogyakarta — Platform Event Mahasiswa</p>
    </footer>

</body>
</html>