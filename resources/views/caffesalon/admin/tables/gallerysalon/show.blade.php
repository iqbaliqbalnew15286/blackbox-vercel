@extends('layouts.admin-app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Gambar Galeri Salon</title>
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
                    <h1 class="text-2xl font-bold text-[#292929]">Detail Gambar Galeri Salon</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.salon.gallery.edit', $gallerysalon->id) }}"
                            class="bg-salon-pink text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b91c6c] transition-colors duration-200 flex items-center space-x-2">
                            <i class="fas fa-edit mr-2"></i>
                            <span>Edit</span>
                        </a>
                        <a href="{{ route('admin.salon.gallery.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition-colors duration-200 flex items-center space-x-2">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri</label>
                        @if ($gallerysalon->image_path)
                            <img src="{{ asset('storage/' . $gallerysalon->image_path) }}" alt="{{ $gallerysalon->name }}"
                                class="w-64 h-64 object-cover rounded-lg shadow-lg">
                        @else
                            <span
                                class="inline-flex items-center justify-center h-64 w-64 rounded-lg bg-gray-200 text-gray-500">
                                <i class="fas fa-image text-4xl"></i>
                            </span>
                        @endif
                    </div>

                    <!-- Informasi -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Gambar</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $gallerysalon->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Upload</label>
                            <p class="text-gray-700">{{ $gallerysalon->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                            <p class="text-gray-700">{{ $gallerysalon->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-salon-pink">
                        <p class="text-gray-800">{{ $gallerysalon->description ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
@endsection
