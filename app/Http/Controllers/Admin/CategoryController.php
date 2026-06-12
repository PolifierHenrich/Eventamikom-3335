<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori dari database.
     * Pertemuan 3 (Tugas) & Pertemuan 6 - Relationship Eloquent
     */
    public function index()
    {
        $categories = Category::withCount('events')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Simpan kategori baru ke database.
     * Pertemuan 8 - CRUD Kategori
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'required|string|max:100|unique:categories,slug|regex:/^[a-z0-9\-]+$/',
        ], [
            'name.required'  => 'Nama kategori wajib diisi.',
            'name.unique'    => 'Nama kategori sudah ada.',
            'slug.required'  => 'Slug wajib diisi.',
            'slug.unique'    => 'Slug sudah digunakan.',
            'slug.regex'     => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-).',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $request->name . '" berhasil ditambahkan.');
    }

    /**
     * Update data kategori.
     * Pertemuan 8 - CRUD Kategori
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'slug' => 'required|string|max:100|unique:categories,slug,' . $category->id . '|regex:/^[a-z0-9\-]+$/',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.unique'   => 'Slug sudah digunakan.',
            'slug.regex'    => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-).',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $category->name . '" berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     * Pertemuan 8 - CRUD Kategori
     */
    public function destroy(Category $category)
    {
        // Cek apakah masih punya event
        if ($category->events()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori "' . $category->name . '" tidak bisa dihapus karena masih memiliki ' . $category->events()->count() . ' event.');
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $name . '" berhasil dihapus.');
    }
}