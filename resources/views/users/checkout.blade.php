@extends('layouts.app')

@section('title', 'Checkout - AmikomEventHub')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-slate-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('events.show') }}" class="hover:text-indigo-600 transition">Jazz Night 2024</a>
        <span class="mx-2">/</span>
        <span class="text-slate-800 font-medium">Checkout</span>
    </nav>

    <h1 class="text-3xl font-black text-slate-900 mb-10">Selesaikan Pemesanan</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ====== KIRI: Form Data Pembeli ====== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Data Diri --}}
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-6">Data Pemesan</h2>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama lengkap Anda"
                               class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" placeholder="email@contoh.com"
                               class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor WhatsApp</label>
                        <input type="tel" placeholder="08xxxxxxxxxx"
                               class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                    </div>
                </div>
            </div>

            {{-- Metode Pembayaran --}}
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-6">Metode Pembayaran</h2>
                <div class="space-y-3">
                    <label class="flex items-center gap-4 p-4 border-2 border-indigo-500 rounded-2xl cursor-pointer bg-indigo-50">
                        <input type="radio" name="payment" checked class="accent-indigo-600 w-4 h-4">
                        <div class="flex-1">
                            <p class="font-bold text-slate-800">Transfer Bank (BCA)</p>
                            <p class="text-sm text-slate-500">Konfirmasi otomatis dalam 1 menit</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition">
                        <input type="radio" name="payment" class="accent-indigo-600 w-4 h-4">
                        <div class="flex-1">
                            <p class="font-bold text-slate-800">QRIS</p>
                            <p class="text-sm text-slate-500">Semua e-wallet & mobile banking</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition">
                        <input type="radio" name="payment" class="accent-indigo-600 w-4 h-4">
                        <div class="flex-1">
                            <p class="font-bold text-slate-800">GoPay / OVO</p>
                            <p class="text-sm text-slate-500">Bayar langsung dari aplikasi</p>
                        </div>
                    </label>
                </div>
            </div>

        </div>

        {{-- ====== KANAN: Ringkasan Pesanan ====== --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm sticky top-24">
                <h2 class="text-xl font-black text-slate-900 mb-6">Ringkasan Pesanan</h2>

                <div class="bg-indigo-50 rounded-2xl p-4 mb-6">
                    <p class="font-black text-slate-800">Jazz Night 2024: A Celebration</p>
                    <p class="text-sm text-slate-500 mt-1">Sabtu, 16 Nov 2024 • 19:30 WIB</p>
                    <p class="text-sm text-slate-500">Blue Note Lounge</p>
                </div>

                <div class="space-y-3 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Tiket Regular × 1</span>
                        <span class="font-bold">Rp 150.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Biaya Layanan</span>
                        <span class="font-bold">Rp 5.000</span>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-8">
                    <span class="font-black text-slate-900">Total</span>
                    <span class="font-black text-indigo-600 text-xl">Rp 155.000</span>
                </div>

                <a href="{{ route('ticket') }}"
                   class="block w-full text-center bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Bayar Sekarang
                </a>
                <a href="{{ route('events.show') }}"
                   class="block text-center mt-3 text-slate-500 text-sm font-medium hover:text-indigo-600 transition">
                    ← Kembali ke Event
                </a>
            </div>
        </div>

    </div>
</div>

@endsection