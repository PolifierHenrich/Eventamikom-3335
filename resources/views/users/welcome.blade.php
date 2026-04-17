@extends('layouts.app')

@section('title', 'AmikomEventHub - Temukan Event Seru')

@section('content')

{{-- ====== HERO SECTION ====== --}}
<section class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-white/20 text-white text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
            Platform Event Terpercaya AMIKOM
        </span>
        <h1 class="text-4xl md:text-6xl font-black leading-tight mb-6">
            Temukan Event <br class="hidden md:block">
            <span class="text-indigo-200">Seru di Sekitarmu</span>
        </h1>
        <p class="text-indigo-100 text-lg max-w-xl mx-auto mb-10">
            Dari konser musik hingga workshop teknologi — semua tiket ada di sini. Pesan sekarang sebelum kehabisan!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('events.show') }}"
               class="bg-white text-indigo-700 font-bold px-8 py-4 rounded-xl hover:bg-indigo-50 transition shadow-lg">
                Lihat Semua Event
            </a>
            <a href="{{ route('ticket') }}"
               class="border-2 border-white/40 text-white font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition">
                Tiket Saya
            </a>
        </div>
    </div>
</section>

{{-- ====== EVENT GRID ====== --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Event Pilihan</h2>
            <p class="text-slate-500 mt-1">Jangan sampai ketinggalan acara terbaik bulan ini.</p>
        </div>
        <a href="{{ route('events.show') }}" class="text-indigo-600 font-bold hover:underline text-sm">Lihat Semua →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Event Card 1 --}}
        <a href="{{ route('events.show') }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="h-52 relative overflow-hidden">
                <img src="{{ asset('assets/concert.png') }}" alt="Jazz Night 2024" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-4 left-4">
                    <span class="bg-black/40 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">Musik</span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-400 font-medium mb-1">Sabtu, 16 November 2024 • 19:30 WIB</p>
                <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition">Jazz Night 2024: A Celebration</h3>
                <p class="text-sm text-slate-500 mb-4">Blue Note Lounge, Yogyakarta</p>
                <div class="flex items-center justify-between">
                    <span class="text-indigo-600 font-black text-lg">Rp 150.000</span>
                    <span class="text-xs text-slate-400 bg-slate-100 px-3 py-1 rounded-full font-medium">Stok: 42</span>
                </div>
            </div>
        </a>

        {{-- Event Card 2 --}}
        <a href="{{ route('events.show') }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="h-52 relative overflow-hidden">
                <img src="{{ asset('assets/workshop.png') }}" alt="AI & Future Workshop" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-4 left-4">
                    <span class="bg-black/40 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">Tech</span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-400 font-medium mb-1">Sabtu, 26 Oktober 2024 • 09:00 WIB</p>
                <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition">AI & Future Workshop</h3>
                <p class="text-sm text-slate-500 mb-4">Auditorium AMIKOM, Yogyakarta</p>
                <div class="flex items-center justify-between">
                    <span class="text-indigo-600 font-black text-lg">Rp 50.000</span>
                    <span class="text-xs text-slate-400 bg-slate-100 px-3 py-1 rounded-full font-medium">Stok: 12</span>
                </div>
            </div>
        </a>

        {{-- Event Card 3 --}}
        <a href="{{ route('events.show') }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="h-52 relative overflow-hidden">
                <img src="{{ asset('assets/hackathon.png') }}" alt="Hackathon 2024" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-4 left-4">
                    <span class="bg-black/40 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">Gratis</span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-400 font-medium mb-1">Minggu, 3 November 2024 • 08:00 WIB</p>
                <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition">Hackathon 2024</h3>
                <p class="text-sm text-slate-500 mb-4">Lab Komputer AMIKOM, Yogyakarta</p>
                <div class="flex items-center justify-between">
                    <span class="text-green-600 font-black text-lg">GRATIS</span>
                    <span class="text-xs text-slate-400 bg-slate-100 px-3 py-1 rounded-full font-medium">Stok: 80</span>
                </div>
            </div>
        </a>

    </div>
</section>

@endsection