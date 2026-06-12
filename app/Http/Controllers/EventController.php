<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Pertemuan 6 - Relationship Eloquent
     * Menampilkan halaman detail event (sisi user) - dinamis dari database.
     */
    public function show($id)
    {
        // Ambil event berdasarkan ID beserta relasi kategori
        $event = Event::with('category')->findOrFail($id);

        return view('users.event-detail', compact('event'));
    }

    /**
     * Pertemuan 10 - Checkout Logic
     * Menampilkan halaman form checkout untuk event tertentu (GET).
     */
    public function checkout($id)
    {
        $event = Event::with('category')->findOrFail($id);

        // Pastikan stok masih ada
        if ($event->stock <= 0) {
            return redirect()->route('events.show', $id)
                ->with('error', 'Maaf, stok tiket untuk event ini sudah habis.');
        }

        return view('users.checkout', compact('event'));
    }

    /**
     * Pertemuan 10 - Checkout Logic & Transaksi
     * Memproses form checkout: validasi (Pertemuan 9) + simpan ke database.
     */
    public function storeCheckout(CheckoutRequest $request, $id)
    {
        // Ambil event, pastikan masih ada
        $event = Event::findOrFail($id);
        $qty   = (int) $request->input('quantity', 1);

        // Cek stok mencukupi
        if ($event->stock < $qty) {
            return back()
                ->withInput()
                ->with('error', "Stok tidak mencukupi. Stok tersisa: {$event->stock} tiket.");
        }

        // Hitung total harga
        $totalPrice = $event->price * $qty;

        // Generate Order ID unik: TRX-YYYYMMDD-XXXXX
        $orderId = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // Simpan transaksi ke database
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'total_price'    => $totalPrice,
            'status'         => 'Pending',
            'snap_token'     => null,
        ]);

        // Kurangi stok event
        $event->decrement('stock', $qty);

        // Redirect ke halaman tiket dengan order_id
        return redirect()->route('ticket.show', $transaction->order_id)
            ->with('success', 'Pemesanan berhasil! Silakan selesaikan pembayaran.');
    }

    /**
     * Pertemuan 10 - Ticket Issuing
     * Menampilkan halaman e-ticket berdasarkan order_id dari transaksi.
     */
    public function showTicket($orderId)
    {
        // Ambil transaksi beserta relasi event
        $transaction = Transaction::with('event')
            ->where('order_id', $orderId)
            ->firstOrFail();

        return view('users.ticket', compact('transaction'));
    }

    /**
     * Halaman tiket tanpa orderId (fallback lama).
     */
    public function ticket()
    {
        return view('users.ticket', ['transaction' => null]);
    }
}