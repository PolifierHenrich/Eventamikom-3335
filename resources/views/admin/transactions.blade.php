@extends('layouts.admin')

@section('title', 'Laporan Transaksi')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus pemesanan dan status pembayaran tiket.')

@section('content')

{{-- Filter Bar --}}
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-6">
    <form action="{{ route('admin.transactions.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">

        {{-- Search --}}
        <div class="flex-1 min-w-[260px]">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari Order ID, Nama, atau Email..."
                   class="w-full px-5 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm font-medium">
        </div>

        {{-- Filter Status --}}
        <select name="status"
                class="px-5 py-3 rounded-xl border border-slate-200 bg-slate-50 outline-none text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
            <option value="">Semua Status</option>
            <option value="Sukses"  {{ request('status') === 'Sukses'  ? 'selected' : '' }}>Sukses</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Gagal"   {{ request('status') === 'Gagal'   ? 'selected' : '' }}>Gagal</option>
        </select>

        <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition text-sm">
            Filter
        </button>
        <a href="{{ route('admin.transactions.index') }}"
           class="px-5 py-3 border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition text-sm">
            Reset
        </a>

    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    <div class="px-8 py-5 border-b flex justify-between items-center">
        <h2 class="font-black text-lg">Semua Transaksi</h2>
        <span class="text-sm text-slate-400 font-medium">
            {{ $transactions->total() }} transaksi ditemukan
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4">Order ID</th>
                    <th class="px-8 py-4">Detail Pembeli</th>
                    <th class="px-8 py-4">Event</th>
                    <th class="px-8 py-4">Tgl Transaksi</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Total Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($transactions as $trx)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6">
                        <span class="font-mono font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg text-sm">
                            #{{ $trx->order_id }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-800">{{ $trx->customer_name }}</p>
                        <p class="text-xs text-slate-500">{{ $trx->customer_email }}</p>
                        <p class="text-xs text-slate-400">{{ $trx->customer_phone }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-medium text-slate-700 max-w-[180px] truncate">
                            {{ $trx->event->title ?? '-' }}
                        </p>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500">
                        {{ $trx->created_at->translatedFormat('d M Y') }}<br>
                        <span class="text-xs">{{ $trx->created_at->format('H:i') }} WIB</span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusClass = match($trx->status) {
                                'Sukses'  => 'bg-green-100 text-green-700 ring-green-200',
                                'Pending' => 'bg-orange-100 text-orange-700 ring-orange-200',
                                'Gagal'   => 'bg-red-100 text-red-700 ring-red-200',
                                default   => 'bg-slate-100 text-slate-600 ring-slate-200',
                            };
                        @endphp
                        <span class="px-3 py-1 {{ $statusClass }} rounded-lg text-xs font-black uppercase ring-1">
                            {{ $trx->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right font-black text-slate-900">
                        @if($trx->total_price > 0)
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        @else
                            <span class="text-green-600">GRATIS</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-slate-500 font-bold">Belum ada transaksi.</p>
                        <p class="text-slate-400 text-sm mt-1">Transaksi akan muncul setelah ada pemesanan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t flex justify-between items-center">
        <p class="text-sm text-slate-500 font-medium">
            Menampilkan {{ $transactions->firstItem() }}–{{ $transactions->lastItem() }}
            dari {{ $transactions->total() }} transaksi
        </p>
        <div class="flex gap-2">
            {{ $transactions->links() }}
        </div>
    </div>
    @endif

</div>

@endsection