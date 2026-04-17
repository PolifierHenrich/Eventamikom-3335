<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan laporan transaksi di panel admin.
     */
    public function index()
    {
        return view('admin.transactions');
    }
}