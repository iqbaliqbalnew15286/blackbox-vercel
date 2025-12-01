@extends('layouts.admin-app')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#292929]">Daftar Testimoni Salon</h1>
            <a href="{{ route('admin.salon.testimonialsalon.create') }}"
                class="bg-[#db2780] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b91c6c] transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Testimoni</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full rounded-lg overflow-hidden border-collapse">
                <thead>
                    <tr class="bg-[#db2780] text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Avatar</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Jabatan/Peran</th>
                        <th class="py-3 px-6 text-left">Kutipan (Quote)</th>
                        <th class="py-3 px-6 text-center">Rating</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($items as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <td class="py-4 px-6 text-left">
                                @if ($item->avatar)
                                    <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}"
                                        class="w-12 h-12 object-cover rounded-full shadow-sm">
                                @else
                                    {{-- Placeholder jika tidak ada avatar --}}
                                    <span
                                        class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 text-gray-500">
                                        <i class="fas fa-user"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-left font-medium">{{ $item->name }}</td>
                            <td class="py-4 px-6 text-left">{{ $item->role ?? '-' }}</td>
                            <td class="py-4 px-6 text-left max-w-sm overflow-hidden truncate">
                                <p class="line-clamp-2 italic">"{{ $item->quote }}"</p>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($item->rating)
                                    <span class="text-yellow-500 font-semibold">{{ $item->rating }} <i
                                            class="fas fa-star text-xs"></i></span>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($item->is_visible)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tampil</span>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Sembunyi</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.salon.testimonialsalon.show', $item->id) }}"
                                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-blue-500 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.salon.testimonialsalon.edit', $item->id) }}"
                                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-[#db2780] transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.salon.testimonialsalon.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors duration-200">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-4">
                                    <i class="fas fa-comments text-4xl text-gray-300"></i>
                                    <p class="text-lg">Belum ada testimoni yang ditambahkan.</p>
                                    <a href="{{ route('admin.salon.testimonialsalon.create') }}"
                                        class="bg-[#db2780] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#b91c6c] transition-colors duration-200 flex items-center space-x-2">
                                        <i class="fas fa-plus mr-2"></i>
                                        <span>Tambah Testimoni Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
