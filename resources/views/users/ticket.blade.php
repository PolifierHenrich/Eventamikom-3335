<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket {{ $transaction ? '#'.$transaction->order_id : '' }} - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-indigo-600 text-white min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full">

        {{-- Success Banner --}}
        <div class="text-center mb-8 no-print">
            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            @if($transaction)
                <h1 class="text-3xl font-black">Pemesanan Berhasil! 🎉</h1>
                <p class="text-indigo-100 mt-2">E-ticket Anda sudah siap. Tunjukkan saat check-in.</p>
            @else
                <h1 class="text-3xl font-black">E-Ticket</h1>
                <p class="text-indigo-100 mt-2">Masukkan Order ID untuk melihat tiket Anda.</p>
            @endif
        </div>

        @if($transaction)
        {{-- Ticket Card --}}
        <div class="bg-white text-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl relative">

            {{-- Ticket Header --}}
            <div class="p-8 bg-indigo-50 border-b-4 border-dashed border-indigo-100 text-center relative">
                <p class="text-indigo-600 font-bold uppercase tracking-widest text-xs mb-2">E-Ticket Resmi · AmikomEventHub</p>
                <h2 class="text-2xl font-black leading-tight">{{ $transaction->event->title ?? 'Event' }}</h2>
                <p class="text-slate-500 text-sm mt-1">
                    {{ optional($transaction->event->date)->translatedFormat('d M Y') }}
                    •
                    {{ optional($transaction->event->date)->format('H:i') }} WIB
                </p>
                {{-- Ticket Side Cuts --}}
                <div class="absolute -left-4 -bottom-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
                <div class="absolute -right-4 -bottom-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
            </div>

            {{-- Ticket Body --}}
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Nama Pembeli</p>
                        <p class="font-bold">{{ $transaction->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Email</p>
                        <p class="font-bold text-sm break-all">{{ $transaction->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Order ID</p>
                        <p class="font-bold font-mono text-indigo-600">{{ $transaction->order_id }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Lokasi</p>
                        <p class="font-bold text-sm">{{ $transaction->event->location ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Total Bayar</p>
                        <p class="font-black text-indigo-600">
                            @if($transaction->total_price > 0)
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            @else
                                GRATIS
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Status</p>
                        @php
                            $badgeClass = match($transaction->status) {
                                'Sukses'  => 'bg-green-100 text-green-700',
                                'Pending' => 'bg-orange-100 text-orange-700',
                                'Gagal'   => 'bg-red-100 text-red-700',
                                default   => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="px-2 py-1 {{ $badgeClass }} rounded-lg text-xs font-black uppercase">
                            {{ $transaction->status }}
                        </span>
                    </div>
                </div>

                {{-- QR Code Mock (dekoratif) --}}
                <div class="bg-slate-100 p-6 rounded-3xl flex flex-col items-center">
                    <p class="text-slate-400 text-xs font-bold uppercase mb-4">Scan QR untuk Check-in</p>
                    <div class="w-40 h-40 bg-white p-3 rounded-xl shadow-inner">
                        {{-- QR Pattern Dekoratif --}}
                        <div class="w-full h-full grid grid-cols-4 grid-rows-4 gap-1">
                            @php
                                $hash = crc32($transaction->order_id);
                                $patterns = [];
                                for ($i = 0; $i < 16; $i++) {
                                    $patterns[] = ($hash >> $i) & 1;
                                }
                            @endphp
                            @foreach($patterns as $p)
                                <div class="rounded-sm {{ $p ? 'bg-slate-900' : 'bg-slate-100' }}"></div>
                            @endforeach
                        </div>
                    </div>
                    <p class="mt-4 font-mono font-bold text-slate-800 text-sm">{{ $transaction->order_id }}</p>
                </div>

                {{-- Note --}}
                @if($transaction->status === 'Pending')
                <div class="bg-orange-50 border border-orange-200 rounded-2xl p-4 text-center">
                    <p class="text-orange-700 font-bold text-sm">⚠️ Menunggu Konfirmasi Pembayaran</p>
                    <p class="text-orange-600 text-xs mt-1">Tiket akan aktif setelah pembayaran dikonfirmasi.</p>
                </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="px-8 pb-8 space-y-3 no-print">
                <button onclick="window.print()"
                        class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 active:scale-95 transition">
                    🖨️ Cetak / Simpan PDF
                </button>
                <a href="{{ route('home') }}"
                   class="block text-center text-slate-500 font-bold hover:text-indigo-600 transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        @else
        {{-- Fallback: input order ID --}}
        <div class="bg-white text-slate-900 rounded-[2rem] p-8 shadow-2xl">
            <h2 class="font-black text-xl mb-2">Cek Tiket Anda</h2>
            <p class="text-slate-500 text-sm mb-6">Masukkan Order ID yang ada di email konfirmasi Anda.</p>
            <form action="" method="GET" class="space-y-4">
                <input type="text" name="order" placeholder="TRX-XXXXXXXX-XXXXX"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-mono">
                <button type="submit"
                        class="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Cari Tiket
                </button>
            </form>
            <a href="{{ route('home') }}" class="block text-center mt-4 text-slate-400 text-sm hover:text-indigo-600">
                Kembali ke Beranda
            </a>
        </div>
        @endif

    </div>

</body>
</html>