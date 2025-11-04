@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Menu Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        :root { --cafe-dark-blue: #091936; --cafe-accent-brown: #58320D; }
        .text-cafe-accent { color: var(--cafe-accent-brown); }
        .bg-cafe-dark { background-color: var(--cafe-dark-blue); }
    </style>
</head>
<body class="bg-gray-100">

<div class="main-content flex-1 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-[#292929]">Detail Menu Item</h1>
            <a href="{{ route('admin.menu.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- KOLOM KIRI: FOTO --}}
            <div class="md:col-span-1">
                @if($menu->photo)
                    <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-200">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500">
                        <i class="fas fa-camera fa-3x"></i>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: DETAIL --}}
            <div class="md:col-span-2">
                <h2 class="text-3xl font-extrabold text-cafe-accent mb-2">{{ $menu->name }}</h2>
                <span class="inline-block text-sm font-semibold bg-gray-200 text-gray-700 px-3 py-1 rounded-full mb-4">{{ $menu->category }}</span>

                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Harga: {{ 'Rp ' . number_format($menu->price, 0, ',', '.') }}
                </h3>

                <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-2 border-b pb-1">Deskripsi</h4>
                <p class="text-gray-600 whitespace-pre-wrap">{{ $menu->description ?? 'Tidak ada deskripsi tersedia.' }}</p>

                <div class="mt-8 flex justify-end space-x-2">
                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="bg-cafe-dark text-white px-6 py-2 rounded-lg font-semibold hover:bg-cafe-accent transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item menu ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition-colors duration-200">
                            <i class="fas fa-trash-alt mr-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

@endsection