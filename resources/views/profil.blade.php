<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto">
        <nav class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 p-3 flex justify-center gap-2 md:gap-4">
            <a href="/" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition font-medium">Home</a>
            <a href="/profil" class="px-5 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 font-semibold transition">Profil</a>
            <a href="/katalog" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition font-medium">Katalog</a>
            <a href="/bantuan" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition font-medium">Bantuan</a>
        </nav>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-lg mx-auto">
            <div class="bg-indigo-600 h-24"></div>
            <div class="px-8 pb-8">
                <div class="relative -mt-12 mb-4 flex justify-center">
                    <div class="w-24 h-24 bg-white rounded-full p-1 shadow-md">
                        <div class="w-full h-full bg-indigo-100 rounded-full flex items-center justify-center text-indigo-500 font-bold text-3xl">
                            W
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-slate-900">Wijdan Ula Rizki</h1>
                    <p class="text-indigo-600 font-medium mt-1">NIM: 24.12.3335</p>
                </div>
                <div class="mt-6 pt-6 border-t border-slate-100">
                    <p class="text-slate-600 text-center leading-relaxed">
                        Mahasiswa Universitas Amikom Yogyakarta. Sedang mengembangkan aplikasi menggunakan framework Laravel dan desain antarmuka dengan Tailwind CSS.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>