@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kelola Kategori')
@section('page_subtitle', 'Atur kategori untuk mengklasifikasikan event dengan rapi.')

@section('content')

{{-- Header Aksi --}}
<header class="flex justify-between items-center mb-8">
    <div>
        <p class="text-slate-500">
            Total <span class="font-black text-slate-800">{{ $categories->count() }}</span> kategori terdaftar.
        </p>
    </div>
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kategori
    </button>
</header>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold text-sm flex items-center gap-2">
        <span>✅</span> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6 font-bold text-sm flex items-center gap-2">
        <span>⚠️</span> {{ session('error') }}
    </div>
@endif

{{-- Validation Errors (dari redirect back) --}}
@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm">
        <p class="font-bold mb-1">Terdapat kesalahan input:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Table --}}
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Nama Kategori</th>
                    <th class="px-8 py-4">Slug</th>
                    <th class="px-8 py-4">Jumlah Event</th>
                    <th class="px-8 py-4">Dibuat</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @php
                    $icons = ['🎵','💻','🎓','🏆','🛠️','🎨','🎤','📚','🎮','🌟'];
                    $colors = [
                        'bg-purple-100 text-purple-600',
                        'bg-blue-100 text-blue-600',
                        'bg-green-100 text-green-600',
                        'bg-orange-100 text-orange-600',
                        'bg-pink-100 text-pink-600',
                        'bg-teal-100 text-teal-600',
                        'bg-rose-100 text-rose-600',
                        'bg-amber-100 text-amber-600',
                        'bg-indigo-100 text-indigo-600',
                        'bg-cyan-100 text-cyan-600',
                    ];
                @endphp

                @forelse($categories as $index => $category)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <span class="w-9 h-9 {{ $colors[$index % count($colors)] }} rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                                {{ $icons[$index % count($icons)] }}
                            </span>
                            <p class="font-black text-slate-800">{{ $category->name }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="font-mono text-sm bg-slate-100 px-3 py-1 rounded-lg text-slate-600">
                            {{ $category->slug }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-700">{{ $category->events_count }}</span>
                            <span class="text-slate-400 text-sm">Event</span>
                            @if($category->events_count > 0)
                                <a href="{{ route('admin.events.index') }}"
                                   class="text-xs text-indigo-600 hover:underline font-medium">(lihat)</a>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500">
                        {{ $category->created_at->translatedFormat('d M Y') }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            {{-- Tombol Edit — buka modal edit --}}
                            <button title="Edit Kategori"
                                    onclick="bukaModalEdit({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->slug }}')"
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>

                            {{-- Tombol Hapus — form POST dengan method DELETE --}}
                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kategori \'{{ $category->name }}\'? Pastikan tidak ada event di kategori ini.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus Kategori"
                                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <p class="text-slate-500 font-bold">Belum ada kategori.</p>
                        <p class="text-slate-400 text-sm mt-1">Mulai dengan menambahkan kategori baru.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- ============================================================ --}}
{{-- MODAL TAMBAH KATEGORI — Form Sungguhan ke Database           --}}
{{-- ============================================================ --}}
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] p-8 w-full max-w-md shadow-2xl">
        <h3 class="text-xl font-black mb-6">Tambah Kategori Baru</h3>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2" for="tambah-name">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="tambah-name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Workshop"
                           oninput="autoSlug(this.value)"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"
                           required>
                </div>
                {{-- Slug --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2" for="tambah-slug">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="tambah-slug"
                           name="slug"
                           value="{{ old('slug') }}"
                           placeholder="workshop"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-mono"
                           required>
                    <p class="text-xs text-slate-400 mt-1">Huruf kecil, tanpa spasi, gunakan tanda hubung (-)</p>
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="button"
                        onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="flex-1 py-3 border-2 border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ============================================================ --}}
{{-- MODAL EDIT KATEGORI — Form Update                            --}}
{{-- ============================================================ --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] p-8 w-full max-w-md shadow-2xl">
        <h3 class="text-xl font-black mb-6">Edit Kategori</h3>

        <form id="form-edit" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2" for="edit-name">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="edit-name"
                           name="name"
                           placeholder="Nama Kategori"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2" for="edit-slug">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="edit-slug"
                           name="slug"
                           placeholder="nama-kategori"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-mono"
                           required>
                    <p class="text-xs text-slate-400 mt-1">Huruf kecil, tanpa spasi, gunakan tanda hubung (-)</p>
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="button"
                        onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="flex-1 py-3 border-2 border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- Script: Auto-slug dari nama + isi form edit --}}
<script>
    // Auto-generate slug dari input nama (modal tambah)
    function autoSlug(value) {
        const slug = value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')   // hapus karakter selain huruf/angka/spasi/dash
            .replace(/\s+/g, '-')             // spasi → dash
            .replace(/-+/g, '-');             // multiple dash → satu dash
        document.getElementById('tambah-slug').value = slug;
    }

    // Buka modal edit & isi form dengan data kategori yang dipilih
    function bukaModalEdit(id, name, slug) {
        const baseUrl = "{{ url('admin/categories') }}";
        document.getElementById('form-edit').action = baseUrl + '/' + id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-slug').value = slug;
        document.getElementById('modal-edit').classList.remove('hidden');
    }

    // Buka modal tambah kembali jika ada error validasi
    @if($errors->any() && old('_token'))
        document.getElementById('modal-tambah').classList.remove('hidden');
    @endif
</script>

@endsection