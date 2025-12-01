@extends('layouts.admin-app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Layanan Salon</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f2f5;
            }

            :root {
                --salon-pink: #db2780;
                --salon-accent-pink: #ffffff;
            }

            .bg-salon-pink {
                background-color: var(--salon-pink);
            }

            .text-salon-accent {
                color: var(--salon-accent-pink);
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <div class="main-content flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-[#292929]">Edit Layanan Salon</h1>
                    <a href="{{ route('admin.salon.layanansalon.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm"
                        role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.salon.layanansalon.update', $layanansalon->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Layanan -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $layanansalon->name) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-salon-pink focus:border-transparent"
                                placeholder="Masukkan nama layanan" required>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <input type="text" id="category" name="category"
                                value="{{ old('category', $layanansalon->category) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-salon-pink focus:border-transparent"
                                placeholder="Masukkan kategori layanan">
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="price" name="price"
                                value="{{ old('price', $layanansalon->price) }}" min="0" step="0.01"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-salon-pink focus:border-transparent"
                                placeholder="Masukkan harga" required>
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Layanan</label>
                            @if ($layanansalon->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $layanansalon->photo) }}"
                                        alt="{{ $layanansalon->name }}" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                </div>
                            @endif
                            <input type="file" id="photo" name="photo" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-salon-pink focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 4MB. Biarkan kosong jika
                                tidak ingin mengubah foto.</p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-salon-pink focus:border-transparent"
                            placeholder="Masukkan deskripsi layanan">{{ old('description', $layanansalon->description) }}</textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('admin.salon.layanansalon.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-salon-pink text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b91c6c] transition-colors duration-200">
                            Update Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
@endsection
