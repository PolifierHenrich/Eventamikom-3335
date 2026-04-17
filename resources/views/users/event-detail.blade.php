@extends('layouts.app')

@section('title', 'Jazz Night 2024 - AmikomEventHub')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-slate-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
        <span class="mx-2">/</span>
        <span class="text-slate-800 font-medium">Jazz Night 2024</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ====== KIRI: Detail Event ====== --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Poster / Banner --}}
            <div class="w-full h-80 rounded-3xl overflow-hidden relative">
                <img src="{{ asset('assets/concert.png') }}" alt="Jazz Night 2024" class="w-full h-full object-cover">
                <div class="absolute bottom-6 left-6">
                    <span class="bg-black/40 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">Musik</span>
                </div>
            </div>

            {{-- Info Event --}}
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <h1 class="text-3xl font-black text-slate-900 mb-4">Jazz Night 2024: A Celebration</h1>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Tanggal</p>
                            <p class="font-bold text-slate-800">Sabtu, 16 Nov 2024</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Waktu</p>
                            <p class="font-bold text-slate-800">19:30 - 23:00 WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Lokasi</p>
                            <p class="font-bold text-slate-800">Blue Note Lounge</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl font-black text-slate-900 mb-3">Tentang Event</h2>
                <p class="text-slate-600 leading-relaxed">
                    Jazz Night 2024 adalah malam perayaan musik jazz yang menampilkan musisi-musisi berbakat dari seluruh Indonesia.
                    Nikmati alunan musik jazz yang memukau sambil menikmati suasana malam yang romantis bersama orang-orang terkasih.
                    Hadir dan jadilah bagian dari malam yang tak terlupakan ini!
                </p>
            </div>
        </div>

        {{-- ====== KANAN: Pembelian Tiket ====== --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm sticky top-24">
                <h2 class="text-xl font-black text-slate-900 mb-6">Beli Tiket</h2>

                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center py-4 border-b border-slate-100">
                        <div>
                            <p class="font-bold text-slate-800">Tiket Regular</p>
                            <p class="text-sm text-slate-400">Akses penuh seluruh area</p>
                        </div>
                        <span class="font-black text-indigo-600 text-lg">Rp 150.000</span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b border-slate-100">
                        <div>
                            <p class="font-bold text-slate-800">Tiket VIP</p>
                            <p class="text-sm text-slate-400">Area premium + minuman</p>
                        </div>
                        <span class="font-black text-indigo-600 text-lg">Rp 300.000</span>
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-2xl p-4 mb-6 flex justify-between items-center">
                    <span class="text-sm font-medium text-indigo-700">Stok tersisa:</span>
                    <span class="font-black text-indigo-700">42 tiket</span>
                </div>

                <a href="{{ route('checkout') }}"
                   class="block w-full text-center bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Pesan Sekarang
                </a>
                <a href="{{ route('home') }}"
                   class="block text-center mt-3 text-slate-500 text-sm font-medium hover:text-indigo-600 transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>
</div>

@endsection