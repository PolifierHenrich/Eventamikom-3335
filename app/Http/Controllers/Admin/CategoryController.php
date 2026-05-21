<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Soal 1 & 3 - READ + Search: Menampilkan daftar kategori dengan pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories', 'search'));
    }

    /**
     * Soal 1 - CREATE: Form tambah kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Soal 1 - CREATE: Simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Soal 1 - UPDATE: Form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Soal 1 - UPDATE: Simpan perubahan kategori ke database.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Soal 1 - DELETE: Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}