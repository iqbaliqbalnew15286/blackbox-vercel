@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Promo</title>
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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#292929]">Detail Promo: {{ $promo->name }}</h1>
            <a href="{{ route('admin.promo.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Kolom Gambar --}}
            <div class="md:col-span-1">
                @if($promo->image)
                    <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->name }}" class="w-full h-auto object-cover rounded-lg shadow-md border">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-lg text-gray-400 border">
                        (Tidak ada gambar)
                    </div>
                @endif
            </div>

            {{-- Kolom Detail --}}
            <div class="md:col-span-2">
                <dl class="divide-y divide-gray-200">
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Nama Promo</dt>
                        <dd class="text-gray-900 font-semibold">{{ $promo->name }}</dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Status</dt>
                        <dd class="text-gray-900">
                            @if($promo->is_active)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Non-Aktif</span>
                            @endif
                        </dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Kode Promo</dt>
                        <dd class="text-gray-900 font-mono text-cafe-accent">{{ $promo->code ?? '-' }}</dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Diskon</dt>
                        <dd class="text-gray-900 font-semibold">
                            @if($promo->discount_type == 'percent')
                                {{ (int)$promo->discount_value }}%
                            @else
                                {{ 'Rp ' . number_format($promo->discount_value, 0, ',', '.') }}
                            @endif
                        </dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Periode Berlaku</dt>
                        <dd class="text-gray-900">{{ $promo->start_date->format('d M Y') }} - {{ $promo->end_date->format('d M Y') }}</D>
                    </div>
                    <div class="py-3 flex flex-col text-sm">
                        <dt class="font-medium text-gray-500 mb-2">Deskripsi</dt>
                        <dd class="text-gray-900 whitespace-pre-line">
                            {{ $promo->description ?? '(Tidak ada deskripsi)' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        
    </div>
</div>

</body>
</html>

@endsection