<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\Category;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Pertemuan 11 - Integrasi Midtrans Snap
 * Controller untuk alur Checkout → Payment → Success
 */
class CheckoutController extends Controller
{
    /**
     * Menampilkan form checkout untuk event tertentu.
     */
    public function show($id)
    {
        $event      = Event::findOrFail($id);
        $categories = Category::all();

        return view('users.checkout', compact('event', 'categories'));
    }

    /**
     * Memproses form checkout:
     * 1. Validasi input
     * 2. Cek stok
     * 3. Generate Order ID unik
     * 4. Simpan transaksi ke DB
     * 5. Generate Snap Token Midtrans
     * 6. Redirect ke halaman pembayaran
     */
    public function store(Request $request, $id)
    {
        // Load Midtrans secara manual untuk hosting yang tidak punya composer autoload
        if (file_exists(base_path('vendor/midtrans/midtrans-php/Midtrans.php'))) {
            require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');
        }

        $event = Event::findOrFail($id);

        // 1. Cek ketersediaan stok
        $quantity = (int) $request->quantity;
        if ($event->stock < $quantity) {
            return back()->with('error', 'Stok tiket tidak mencukupi. Stok tersisa: ' . $event->stock);
        }

        // 2. Hitung total harga
        $totalPrice = $event->price * $quantity;

        // 3. Generate Order ID unik
        $orderId = 'EVT-' . strtoupper(Str::random(8)) . '-' . time();

        // 4. Simpan transaksi ke database
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
            'snap_token'     => null,
        ]);

        // Kurangi stok event
        $event->decrement('stock', $quantity);

        // --- INTEGRASI SNAP MIDTRANS ---

        // Konfigurasi Kredensial Environment Midtrans
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        // Susun Paket Array Data Transaksi
        $params = [
            'transaction_details' => [
                'order_id'    => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email'      => $request->customer_email,
                'phone'      => $request->customer_phone,
            ],
        ];

        try {
            // Generate Snap Token dari Midtrans API
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Simpan snap_token ke database
            $transaction->update(['snap_token' => $snapToken]);

            // Redirect ke halaman pembayaran
            return redirect()->route('checkout.payment', $transaction->order_id);

        } catch (\Exception $e) {
            // Rollback: hapus transaksi dan kembalikan stok jika gagal
            $transaction->delete();
            $event->increment('stock', $quantity);

            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman popup Midtrans Snap untuk pembayaran.
     */
    public function payment($order_id)
    {
        $categories  = Category::all();
        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view('checkout.payment', compact('transaction', 'categories'));
    }

    /**
     * Halaman sukses setelah pembayaran selesai.
     * Memvalidasi status asli dari Midtrans sebelum mengubah status transaksi.
     */
    public function success($order_id)
    {
        $categories  = Category::all();
        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        // Load Midtrans secara manual untuk hosting yang tidak punya composer autoload
        if (file_exists(base_path('vendor/midtrans/midtrans-php/Midtrans.php'))) {
            require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');
        }

        // Validasi status pembayaran dari Midtrans
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);

            // Update status ke 'success' hanya jika Midtrans mengkonfirmasi
            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}
