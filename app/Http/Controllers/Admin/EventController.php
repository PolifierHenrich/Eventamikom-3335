<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menentukan disk storage yang digunakan.
     * Lokal: 'public' | Laravel Cloud (AWS_BUCKET terisi): 'r2'
     */
    private function storageDisk(): string
    {
        return env('AWS_BUCKET') ? 'r2' : 'public';
    }

    /**
     * 5.4.4 READ - Menampilkan daftar event dengan paginasi
     */
    public function index()
    {
        $events = \App\Models\Event::with('category')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * 5.4.5 CREATE - Form tambah event baru
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.events.create', compact('categories'));
    }

    /**
     * 5.4.5 CREATE - Simpan event baru ke database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Hapus key 'poster' dari $data (bukan nama kolom di database)
        unset($data['poster']);

        // Upload poster ke disk yang sesuai (lokal: public | cloud: r2)
        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')
                ->store('posters', $this->storageDisk());
        }

        \App\Models\Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Data Event berhasil ditambahkan.');
    }

    /**
     * 5.4.7 UPDATE - Form edit event
     */
    public function edit(Event $event)
    {
        $categories = \App\Models\Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * 5.4.7 UPDATE - Simpan perubahan data event
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Hapus key 'poster' dari $data (bukan nama kolom di database)
        unset($data['poster']);

        // Upload poster baru & hapus yang lama jika ada file baru
        if ($request->hasFile('poster')) {
            if ($event->poster_path) {
                Storage::disk($this->storageDisk())->delete($event->poster_path);
            }
            $data['poster_path'] = $request->file('poster')
                ->store('posters', $this->storageDisk());
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Rincian data event berhasil diperbarui.');
    }

    /**
     * 5.4.6 DELETE - Hapus event dari database
     */
    public function destroy(Event $event)
    {
        if ($event->poster_path) {
            Storage::disk($this->storageDisk())->delete($event->poster_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Data event berhasil dihapus secara permanen.');
    }
}