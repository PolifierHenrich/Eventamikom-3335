@extends('layouts.admin')

@section('title', 'Dashboard - Admin')
@section('page_title', 'Dashboard Ringkasan')
@section('page_subtitle', 'Selamat datang kembali, Admin! Berikut ringkasan data terbaru.')

@section('content')

{{-- Stats Grid - Data dari Database --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    {{-- Total Pendapatan --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-slate-400 text-sm font-bold uppercase mb-1">Total Pendapatan</p>
        <h3 class="text-2xl font-black">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
    </div>

    {{-- Total Event --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <p class="text-slate-400 text-sm font-bold uppercase mb-1">Total Event</p>
        <h3 class="text-2xl font-black">{{ $totalEvents }} Event</h3>
    </div>

    {{-- Total Transaksi --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <p class="text-slate-400 text-sm font-bold uppercase mb-1">Total Transaksi</p>
        <h3 class="text-2xl font-black">{{ $totalTransactions }} Pesanan</h3>
    </div>

    {{-- Pesanan Pending --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-slate-400 text-sm font-bold uppercase mb-1">Pesanan Pending</p>
        <h3 class="text-2xl font-black">{{ $totalPending }} Pesanan</h3>
    </div>

</div>

{{-- Row 2: Event Terbaru & Info Kategori/Partner --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

    {{-- Event Terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-black text-lg">Event Terbaru</h3>
            <a href="{{ route('admin.events.index') }}" class="text-indigo-600 font-bold hover:underline text-sm">
                Kelola Semua →
            </a>
        </div>
        <div class="divide-y">
            @forelse($latestEvents as $event)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-800 truncate">{{ $event->title }}</p>
                    <p class="text-xs text-slate-400">{{ $event->category->name ?? '-' }} •
                       {{ $event->date->format('d M Y') }}</p>
                </div>
                <span class="font-black text-indigo-600 text-sm whitespace-nowrap">
                    @if($event->price > 0)
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    @else
                        GRATIS
                    @endif
                </span>
            </div>
            @empty
            <div class="p-8 text-center text-slate-400">Belum ada event.</div>
            @endforelse
        </div>
    </div>

    {{-- Info Singkat --}}
    <div class="space-y-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-400 text-xs font-bold uppercase mb-2">Kategori Terdaftar</p>
            <p class="text-4xl font-black text-slate-800">{{ $totalCategories }}</p>
            <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 font-bold text-sm hover:underline mt-1 inline-block">
                Kelola Kategori →
            </a>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-400 text-xs font-bold uppercase mb-2">Total Partner</p>
            <p class="text-4xl font-black text-slate-800">{{ $totalPartners }}</p>
            <a href="{{ route('admin.partners.index') }}" class="text-indigo-600 font-bold text-sm hover:underline mt-1 inline-block">
                Kelola Partner →
            </a>
        </div>
    </div>

</div>

{{-- Transaksi Terakhir --}}
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-8 border-b flex justify-between items-center">
        <h3 class="font-black text-xl">Transaksi Terakhir</h3>
        <a href="{{ route('admin.transactions.index') }}" class="text-indigo-600 font-bold hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4">Pembeli</th>
                    <th class="px-8 py-4">Event</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($latestTransactions as $trx)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-8 py-6">
                        <p class="font-bold uppercase tracking-wide text-sm">{{ $trx->customer_name }}</p>
                        <p class="text-xs text-slate-400">{{ $trx->customer_email }}</p>
                    </td>
                    <td class="px-8 py-6 font-medium text-slate-600">{{ $trx->event->title ?? '-' }}</td>
                    <td class="px-8 py-6">
                        @php
                            $statusClass = match($trx->status) {
                                'Sukses' => 'bg-green-100 text-green-700',
                                'Pending' => 'bg-orange-100 text-orange-700',
                                'Gagal' => 'bg-red-100 text-red-700',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="px-3 py-1 {{ $statusClass }} rounded-lg text-xs font-bold uppercase">
                            {{ $trx->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 font-black text-indigo-600">
                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-10 text-center text-slate-400">
                        Belum ada transaksi yang masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection