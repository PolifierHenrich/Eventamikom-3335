@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title . ' | AmikomEventHub')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-slate-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('events.show', $event->id) }}" class="hover:text-indigo-600 transition">{{ $event->title }}</a>
        <span class="mx-2">/</span>
        <span class="text-slate-800 font-medium">Checkout</span>
    </nav>

    <h1 class="text-3xl font-black text-slate-900 mb-10">Selesaikan Pemesanan</h1>

    {{-- Error & Success Flash --}}
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 mb-6 flex items-center gap-3 font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Pertemuan 10: Form POST ke storeCheckout --}}
    <form action="{{ route('checkout.store', $event->id) }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ====== KIRI: Form Data Pembeli ====== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Data Diri --}}
                {{-- Pertemuan 9: Validasi menggunakan CheckoutRequest --}}
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 mb-6">Data Pemesan</h2>
                    <div class="space-y-5">

                        {{-- Nama --}}
                        <div>
                            <label for="customer_name" class="block text-sm font-bold text-slate-700 mb-2">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   id="customer_name"
                                   name="customer_name"
                                   value="{{ old('customer_name') }}"
                                   placeholder="Masukkan nama lengkap Anda"
                                   class="w-full px-5 py-3 rounded-xl border @error('customer_name') border-red-400 bg-red-50 @else border-slate-200 @enderror
                                          focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                            @error('customer_name')
                                <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="customer_email" class="block text-sm font-bold text-slate-700 mb-2">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email"
                                   id="customer_email"
                                   name="customer_email"
                                   value="{{ old('customer_email') }}"
                                   placeholder="email@contoh.com"
                                   class="w-full px-5 py-3 rounded-xl border @error('customer_email') border-red-400 bg-red-50 @else border-slate-200 @enderror
                                          focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                            @error('customer_email')
                                <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label for="customer_phone" class="block text-sm font-bold text-slate-700 mb-2">
                                Nomor WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel"
                                   id="customer_phone"
                                   name="customer_phone"
                                   value="{{ old('customer_phone') }}"
                                   placeholder="08xxxxxxxxxx"
                                   class="w-full px-5 py-3 rounded-xl border @error('customer_phone') border-red-400 bg-red-50 @else border-slate-200 @enderror
                                          focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                            @error('customer_phone')
                                <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Jumlah Tiket --}}
                        <div>
                            <label for="quantity" class="block text-sm font-bold text-slate-700 mb-2">
                                Jumlah Tiket <span class="text-rose-500">*</span>
                            </label>
                            <select id="quantity"
                                    name="quantity"
                                    class="w-full px-5 py-3 rounded-xl border @error('quantity') border-red-400 bg-red-50 @else border-slate-200 @enderror
                                           focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm font-medium">
                                @for($i = 1; $i <= min(10, $event->stock); $i++)
                                    <option value="{{ $i }}" {{ old('quantity', 1) == $i ? 'selected' : '' }}>
                                        {{ $i }} Tiket
                                    </option>
                                @endfor
                            </select>
                            @error('quantity')
                                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Info Pembayaran --}}
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 mb-6">Metode Pembayaran</h2>
                    <div class="p-5 bg-indigo-50 border-2 border-indigo-200 rounded-2xl flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-black text-slate-800">Midtrans Payment Gateway</p>
                            <p class="text-sm text-slate-500">Transfer Bank, QRIS, GoPay, OVO, dan lainnya</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 font-medium">
                        * Anda akan diarahkan ke halaman pembayaran Midtrans setelah konfirmasi pesanan.
                    </p>
                </div>

            </div>

            {{-- ====== KANAN: Ringkasan Pesanan ====== --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm sticky top-24">
                    <h2 class="text-xl font-black text-slate-900 mb-6">Ringkasan Pesanan</h2>

                    {{-- Info Event --}}
                    <div class="bg-indigo-50 rounded-2xl p-4 mb-6">
                        <p class="font-black text-slate-800 text-sm">{{ $event->title }}</p>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $event->date->translatedFormat('d M Y') }} • {{ $event->date->format('H:i') }} WIB
                        </p>
                        <p class="text-xs text-slate-500">{{ $event->location }}</p>
                    </div>

                    {{-- Rincian Harga --}}
                    <div class="space-y-3 border-b border-slate-100 pb-4 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600">
                                @if($event->price > 0)
                                    Rp {{ number_format($event->price, 0, ',', '.') }} × <span id="qty-display">1</span>
                                @else
                                    Tiket Gratis
                                @endif
                            </span>
                            <span class="font-bold" id="subtotal-display">
                                @if($event->price > 0)
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                @else
                                    GRATIS
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600">Biaya Layanan</span>
                            <span class="font-bold text-green-600">Rp 0</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="font-black text-slate-900">Total</span>
                        <span class="font-black text-indigo-600 text-xl" id="total-display">
                            @if($event->price > 0)
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            @else
                                GRATIS
                            @endif
                        </span>
                    </div>

                    <button type="submit"
                            class="w-full text-center bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 active:scale-95">
                        ✅ Konfirmasi Pesanan
                    </button>
                    <a href="{{ route('events.show', $event->id) }}"
                       class="block text-center mt-3 text-slate-500 text-sm font-medium hover:text-indigo-600 transition">
                        ← Kembali ke Detail Event
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection

@section('scripts')
{{-- Pertemuan 10: Update ringkasan harga secara real-time --}}
<script>
    const qtySelect     = document.getElementById('quantity');
    const pricePerUnit  = {{ $event->price }};
    const qtyDisplay    = document.getElementById('qty-display');
    const subtotalDisp  = document.getElementById('subtotal-display');
    const totalDisp     = document.getElementById('total-display');

    function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    function updateSummary() {
        if (pricePerUnit === 0) return; // Skip if free
        const qty      = parseInt(qtySelect.value);
        const subtotal = pricePerUnit * qty;
        if (qtyDisplay)   qtyDisplay.textContent   = qty;
        if (subtotalDisp) subtotalDisp.textContent  = formatRupiah(subtotal);
        if (totalDisp)    totalDisp.textContent     = formatRupiah(subtotal);
    }

    if (qtySelect) {
        qtySelect.addEventListener('change', updateSummary);
    }
</script>
@endsection