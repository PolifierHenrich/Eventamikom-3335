@extends('layouts.admin')

@section('title', 'Kelola Partner - Admin')
@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Manajemen daftar mitra dan sponsor AmikomEventHub.')

@section('content')

<div class="mb-6 text-right">
    <a href="{{ route('admin.partners.create') }}"
       class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
        + Tambah Partner Baru
    </a>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Logo</th>
                    <th class="px-8 py-4">Nama Partner</th>
                    <th class="px-8 py-4">Deskripsi</th>
                    <th class="px-8 py-4">Website</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($partners as $index => $partner)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">{{ $partners->firstItem() + $index }}</td>
                    <td class="px-8 py-6">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                 class="w-12 h-12 rounded-xl object-contain border border-slate-100 bg-slate-50 p-1">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-lg">
                                {{ strtoupper(substr($partner->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500 max-w-xs truncate">
                        {{ $partner->description ?? '-' }}
                    </td>
                    <td class="px-8 py-6">
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank"
                               class="text-indigo-600 font-medium hover:underline text-sm">
                                Buka ↗
                            </a>
                        @else
                            <span class="text-slate-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.partners.edit', $partner) }}"
                               class="px-4 py-2 bg-amber-100 text-amber-700 rounded-xl font-bold text-sm hover:bg-amber-200 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus partner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 bg-red-100 text-red-700 rounded-xl font-bold text-sm hover:bg-red-200 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="font-bold text-slate-500">Belum ada data partner.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-8 py-6 bg-slate-50/50 border-t">
        {{ $partners->links() }}
    </div>
</div>

@endsection
