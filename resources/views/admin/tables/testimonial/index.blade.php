@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Testimoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        :root { --cafe-dark-blue: #091936; --cafe-accent-brown: #58320D; }
        .bg-cafe-dark { background-color: var(--cafe-dark-blue); }
        .text-cafe-accent { color: var(--cafe-accent-brown); }
    </style>
</head>
<body class="bg-gray-100">

<div class="main-content flex-1 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#292929]">Daftar Testimoni</h1>
            <a href="{{ route('admin.testimonial.create') }}" class="bg-cafe-dark text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1a3a6c] transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Testimoni</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full rounded-lg overflow-hidden border-collapse">
                <thead>
                    <tr class="bg-cafe-dark text-white uppercase text-sm leading-normal">
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
                                @if($item->avatar)
                                    <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}" class="w-12 h-12 object-cover rounded-full shadow-sm">
                                @else
                                    {{-- Placeholder jika tidak ada avatar --}}
                                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 text-gray-500">
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
                                @if($item->rating)
                                    <span class="text-yellow-500 font-semibold">{{ $item->rating }} <i class="fas fa-star text-xs"></i></span>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($item->is_visible)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tampil</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Sembunyi</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.testimonial.show', $item->id) }}" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-blue-500 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.testimonial.edit', $item->id) }}" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-cafe-accent transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonial.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors duration-200">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">Belum ada testimoni yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

@endsection