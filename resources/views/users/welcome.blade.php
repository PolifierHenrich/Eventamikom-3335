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
            <a href="#events"
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

{{-- ====== EVENT GRID — DATA DARI DATABASE ====== --}}
<section id="events" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Event Pilihan</h2>
            <p class="text-slate-500 mt-1">Jangan sampai ketinggalan acara terbaik bulan ini.</p>
        </div>
        <span class="text-sm text-slate-400 font-medium">{{ $events->count() }} Event Tersedia</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($events as $event)
        {{-- Event Card Dinamis dari DB --}}
        <a href="{{ route('events.show', $event->id) }}"
           class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">

            {{-- Poster Event --}}
            <div class="h-52 relative overflow-hidden bg-indigo-50">
                @if($event->poster_path)
                    <img src="{{ Storage::url($event->poster_path) }}"
                         alt="{{ $event->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    {{-- Fallback berdasarkan kategori --}}
                    @php
                        $colors = ['from-indigo-500 to-purple-600', 'from-green-500 to-teal-600',
                                   'from-orange-500 to-red-600', 'from-blue-500 to-indigo-600',
                                   'from-pink-500 to-rose-600', 'from-amber-500 to-orange-600'];
                        $color = $colors[$event->id % count($colors)];
                    @endphp
                    <div class="w-full h-full bg-gradient-to-br {{ $color }} flex items-center justify-center group-hover:scale-105 transition duration-500">
                        <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                @endif

                {{-- Badge Kategori --}}
                <div class="absolute top-4 left-4">
                    <span class="bg-black/40 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $event->category->name ?? 'Umum' }}
                    </span>
                </div>

                {{-- Badge Gratis --}}
                @if($event->price == 0)
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">GRATIS</span>
                </div>
                @endif
            </div>

            {{-- Info Event --}}
            <div class="p-6">
                <p class="text-xs text-slate-400 font-medium mb-1">
                    {{ $event->date->translatedFormat('l, d F Y') }} • {{ $event->date->format('H:i') }} WIB
                </p>
                <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition line-clamp-2">
                    {{ $event->title }}
                </h3>
                <p class="text-sm text-slate-500 mb-4">{{ $event->location }}</p>
                <div class="flex items-center justify-between">
                    @if($event->price > 0)
                        <span class="text-indigo-600 font-black text-lg">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    @else
                        <span class="text-green-600 font-black text-lg">GRATIS</span>
                    @endif
                    <span class="text-xs text-slate-400 bg-slate-100 px-3 py-1 rounded-full font-medium">
                        Stok: {{ $event->stock }}
                    </span>
                </div>
            </div>
        </a>
        @empty
        {{-- Jika tidak ada event --}}
        <div class="col-span-3 text-center py-20">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-slate-500 font-bold text-lg">Belum ada event yang tersedia.</p>
            <p class="text-slate-400 text-sm mt-1">Cek kembali nanti ya!</p>
        </div>
        @endforelse

    </div>
</section>

@endsection