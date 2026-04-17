<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AmikomEventHub - Event Terbaik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800">

    {{-- ====== NAVBAR USER ====== --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-slate-900">AmikomEventHub</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium transition {{ request()->routeIs('home') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Home</a>
                    <a href="{{ route('events.show') }}" class="text-sm font-medium transition {{ request()->routeIs('events.*') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Events</a>
                    <a href="{{ route('checkout') }}" class="text-sm font-medium transition {{ request()->routeIs('checkout') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Checkout</a>
                    <a href="{{ route('ticket') }}" class="text-sm font-medium transition {{ request()->routeIs('ticket') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Tiket Saya</a>
                </div>
                <a href="{{ route('events.show') }}" class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Jelajahi Event
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-400 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-indigo-500 rounded-md flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold">AmikomEventHub</span>
                </div>
                <p class="text-sm">&copy; {{ date('Y') }} Universitas AMIKOM Yogyakarta. All rights reserved.</p>
                <div class="flex gap-4 text-sm">
                    <a href="#" class="hover:text-white transition">Tentang</a>
                    <a href="#" class="hover:text-white transition">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>