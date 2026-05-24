@extends('layouts.admin')

@section('title', 'Kelola Partner - Admin')
@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Atur daftar partner yang mendukung platform AmikomEventHub.')

@section('content')

{{-- Header: Tombol Tambah --}}
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.partners.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Partner
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    {{-- Search Bar (Soal 3) --}}
    <div class="px-8 py-6 bg-slate-50/50 border-b">
        <form method="GET" action="{{ route('admin.partners.index') }}" class="flex gap-3">
            <input type="text"
                   name="search"
                   value="{{ $search ?? '' }}"
                   placeholder="Cari nama partner..."
                   class="flex-1 px-5 py-3 rounded-xl border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
            <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition text-sm">
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.partners.index') }}"
                   class="px-5 py-3 bg-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-300 transition text-sm">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">ID</th>
                    <th class="px-8 py-4">Logo</th>
                    <th class="px-8 py-4">Nama Partner</th>
                    <th class="px-8 py-4">Dibuat</th>
                    <th class="px-8 py-4">Diperbarui</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($partners as $index => $partner)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">{{ $partners->firstItem() + $index }}</td>
                    <td class="px-8 py-6">
                        <span class="font-mono text-xs bg-slate-100 px-2 py-1 rounded-lg text-slate-500">{{ $partner->id }}</span>
                    </td>
                    <td class="px-8 py-6">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                 class="w-12 h-12 object-contain rounded-xl border border-slate-100 bg-white p-1"
                                 onerror="this.style.display='none'">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500">
                        {{ $partner->created_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500">
                        {{ $partner->updated_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                               class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                               title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus partner \'{{ $partner->name }}\'?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-8 py-16 text-center text-slate-400">
                        <p class="text-4xl mb-4">🤝</p>
                        <p class="font-bold">Belum ada partner{{ $search ? ' yang cocok dengan pencarian.' : '.' }}</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-8 py-6 bg-slate-50/50 border-t">
        {{ $partners->links() }}
    </div>
</div>

@endsection
