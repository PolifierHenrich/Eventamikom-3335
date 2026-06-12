<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan statistik dari database.
     * Implementasi Pertemuan 6: Relationship Eloquent & Filter Data
     */
    public function index()
    {
        // Hitung statistik dari database
        $totalEvents       = Event::count();
        $totalCategories   = Category::count();
        $totalTransactions = Transaction::count();
        $totalPendapatan   = Transaction::where('status', 'Sukses')->sum('total_price');
        $totalPending      = Transaction::where('status', 'Pending')->count();
        $totalPartners     = Partner::count();

        // 5 transaksi terbaru untuk tabel ringkasan
        $latestTransactions = Transaction::with('event')
            ->latest()
            ->take(5)
            ->get();

        // 3 event terbaru
        $latestEvents = Event::with('category')->latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalCategories',
            'totalTransactions',
            'totalPendapatan',
            'totalPending',
            'totalPartners',
            'latestTransactions',
            'latestEvents'
        ));
    }
}
