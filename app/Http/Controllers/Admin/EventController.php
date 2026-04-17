<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event di panel admin.
     */
    public function index()
    {
        return view('admin.events');
    }
}