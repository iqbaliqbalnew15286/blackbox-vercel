@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Promo Baru</title>
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
            <h1 class="text-2xl font-bold text-[#292929]">Tambah Promo Baru</h1>
            <a href="{{ route('admin.promo.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Promo</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('name') border-red-500 @enderror" value="{{ old('name') }}" placeholder="Contoh: Promo Gajian">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4 flex space-x-4">
                <div class="w-1/2">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Promo (Opsional)</label>
                    <input type="text" name="code" id="code" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('code') border-red-500 @enderror" value="{{ old('code') }}" placeholder="Contoh: GAJIAN20">
                    @error('code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                    <select name="discount_type" id="discount_type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('discount_type') border-red-500 @enderror">
                        <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Persen (%)</option>
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Potongan Tetap (Rp)</option>
                    </select>
                    @error('discount_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4 flex space-x-4">
                <div class="w-1/2">
                    <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                    <input type="number" step="any" name="discount_value" id="discount_value" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('discount_value') border-red-500 @enderror" value="{{ old('discount_value') }}" placeholder="Contoh: 20 (untuk 20%) atau 10000 (untuk Rp10.000)">
                    @error('discount_value')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Promo (Opsional)</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4 flex space-x-4">
                <div class="w-1/2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Berlaku</label>
                    <input type="date" name="start_date" id="start_date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="rounded border-gray-300 text-cafe-dark focus:ring-cafe-accent" checked>
                    <span class="ml-2 text-sm text-gray-700">Aktifkan promo ini</span>
                </label>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-cafe-dark text-white px-6 py-2 rounded-lg font-semibold hover:bg-cafe-accent transition-colors duration-200"
                        style="background-color: var(--cafe-dark-blue); hover-bg-color: var(--cafe-accent-brown);">
                    Simpan Promo
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

@endsection