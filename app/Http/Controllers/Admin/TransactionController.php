<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Pertemuan 10 & 12 - Menampilkan laporan transaksi dengan data dari database.
     */
    public function index(Request $request)
    {
        $query = Transaction::with('event')->latest();

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Pencarian berdasarkan order_id, nama, atau email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('admin.transactions', compact('transactions'));
    }
}