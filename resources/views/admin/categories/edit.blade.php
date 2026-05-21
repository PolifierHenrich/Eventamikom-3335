@extends('layouts.admin')

@section('title', 'Edit Kategori - Admin')
@section('page_title', 'Edit Kategori')
@section('page_subtitle', 'Ubah nama kategori yang sudah ada.')

@section('content')

<div class="max-w-xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                    Nama Kategori <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       placeholder="Nama kategori..."
                       class="w-full px-5 py-3 rounded-xl border @error('name') border-rose-400 bg-rose-50 @else border-slate-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                @error('name')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info kolom --}}
            <div class="mb-6 p-4 bg-slate-50 rounded-xl text-xs text-slate-500 space-y-1 border border-slate-100">
                <p><span class="font-bold">ID:</span> {{ $category->id }}</p>
                <p><span class="font-bold">Dibuat:</span> {{ $category->created_at->format('d M Y, H:i') }}</p>
                <p><span class="font-bold">Diperbarui:</span> {{ $category->updated_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 active:scale-95 transition">
                    Perbarui Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
