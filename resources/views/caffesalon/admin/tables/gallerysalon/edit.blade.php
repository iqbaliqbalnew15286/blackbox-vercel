@extends('layouts.admin-app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Item Galeri</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f2f5;
            }

            :root {
                --cafe-dark-blue: #000000;
                --cafe-accent-brown: #ffffff;
            }

            .text-cafe-accent {
                color: var(--cafe-accent-brown);
            }

            .bg-cafe-dark {
                background-color: var(--cafe-dark-blue);
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <div class="main-content flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-[#292929]">Edit Item Galeri</h1>
                    <a href="{{ route('admin.salon.gallery.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                {{-- Menggunakan $gallery->id dan method PUT --}}
                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama/Judul Gambar</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('name') border-red-500 @enderror"
                            value="{{ old('name', $gallery->name) }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar
                            (Opsional)</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($gallery->image_path)
                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gambar {{ $gallery->name }}"
                                class="w-48 h-auto object-cover rounded-lg shadow-sm border">
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('description') border-red-500 @enderror">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-cafe-dark text-white px-6 py-2 rounded-lg font-semibold hover:bg-cafe-accent transition-colors duration-200"
                            style="background-color: var(--cafe-dark-blue); hover-bg-color: var(--cafe-accent-brown);">
                            Perbarui Item
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
@endsection
