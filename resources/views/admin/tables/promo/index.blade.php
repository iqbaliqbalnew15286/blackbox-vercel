@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-s8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Promo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }
        :root { --cafe-dark-blue: #091936; --cafe-accent-brown: #58320D; }
        .bg-cafe-dark { background-color: var(--cafe-dark-blue); }
        .text-cafe-accent { color: var(--cafe-accent-brown); }
    </style>
</head>
<body class="bg-gray-100">

<div class="main-content flex-1 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#292929]">Daftar Promo</h1>
            {{-- Mengarahkan ke route create promo --}}
            <a href="{{ route('admin.promo.create') }}" class="bg-cafe-dark text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1a3a6c] transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Promo Baru</span>
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
                        <th class="py-3 px-6 text-left">Nama Promo</th>
                        <th class="py-3 px-6 text-left">Gambar</th>
                        <th class="py-3 px-6 text-left">Kode</th>
                        <th class="py-3 px-6 text-left">Diskon</th>
                        <th class="py-3 px-6 text-left">Periode Valid</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    {{-- Loop dari $items (PromoItem) --}}
                    @forelse($items as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <td class="py-4 px-6 text-left font-medium">{{ $item->name }}</td>
                            <td class="py-4 px-6 text-left">
                                {{-- Menggunakan $item->image (sesuai migration) --}}
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-left font-mono text-cafe-accent">{{ $item->code ?? '-' }}</td>
                            <td class="py-4 px-6 text-left font-semibold">
                                {{-- Logika untuk menampilkan diskon (persen/tetap) --}}
                                @if($item->discount_type == 'percent')
                                    {{ (int)$item->discount_value }}%
                                @else
                                    {{ 'Rp ' . number_format($item->discount_value, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="py-4 px-6 text-left">
                                {{-- Format tanggal start_date dan end_date --}}
                                {{ $item->start_date->format('d M Y') }} - {{ $item->end_date->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                {{-- Badge untuk status is_active --}}
                                @if($item->is_active)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    {{-- Menggunakan route admin.promo.* --}}
                                    <a href="{{ route('admin.promo.show', $item->id) }}" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-blue-500 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.promo.edit', $item->id) }}" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-cafe-accent transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.promo.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');">
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
                            {{-- Sesuaikan colspan dengan jumlah <th> --}}
                            <td colspan="7" class="py-8 text-center text-gray-500">Belum ada promo yang ditambahkan.</td>
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