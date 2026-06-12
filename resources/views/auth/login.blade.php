<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-slate-900 min-h-screen flex items-center justify-center p-4">

    {{-- Background decorative circles --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-2xl font-black text-white tracking-tight">AmikomEventHub</span>
            </div>
            <p class="text-indigo-200 font-medium">Panel Admin · Masuk untuk mengelola</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-black/30 p-8">

            <h1 class="text-2xl font-black text-slate-900 mb-2">Selamat Datang 👋</h1>
            <p class="text-slate-500 mb-8 text-sm">Masukkan kredensial Anda untuk mengakses panel admin.</p>

            {{-- Flash Error --}}
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Flash Success --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 text-sm font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@amikom.ac.id"
                        class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 @enderror
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 outline-none transition text-sm"
                        autocomplete="email"
                        autofocus
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 @enderror
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 outline-none transition text-sm"
                        autocomplete="current-password"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" id="remember"
                               class="w-4 h-4 text-indigo-600 rounded border-slate-300 accent-indigo-600">
                        <span class="text-sm text-slate-600 font-medium">Ingat Saya</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        id="btn-login"
                        class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 active:scale-[0.98] transition shadow-lg shadow-indigo-200 text-sm">
                    Masuk ke Panel Admin
                </button>

            </form>

            {{-- Hint Kredensial (dev only) --}}
            <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wide mb-2">💡 Default Admin</p>
                <p class="text-xs text-slate-600 font-mono">Email: admin@amikom.ac.id</p>
                <p class="text-xs text-slate-600 font-mono">Pass: password</p>
            </div>

        </div>

        {{-- Kembali ke Beranda --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-indigo-200 text-sm font-medium hover:text-white transition">
                ← Kembali ke Beranda
            </a>
        </div>

    </div>

</body>
</html>
