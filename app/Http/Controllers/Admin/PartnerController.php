<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Soal 2 & 3 - READ + Search: Menampilkan daftar partner dengan pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    /**
     * Soal 2 - CREATE: Form tambah partner baru.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Soal 2 - CREATE: Simpan partner baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        Partner::create($request->only(['name', 'logo_url']));

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan.');
    }

    /**
     * Soal 2 - UPDATE: Form edit partner.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Soal 2 - UPDATE: Simpan perubahan partner ke database.
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        $partner->update($request->only(['name', 'logo_url']));

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui.');
    }

    /**
     * Soal 2 - DELETE: Hapus partner dari database.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}
