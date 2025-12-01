@extends('layouts.admin-app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Testimoni</title>
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

            .focus\:ring-cafe-accent:focus {
                --tw-ring-color: var(--cafe-accent-brown);
                border-color: var(--cafe-accent-brown);
                box-shadow: 0 0 0 2px var(--tw-ring-color);
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <div class="main-content flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-[#292929]">Edit Testimoni</h1>
                    <a href="{{ route('admin.caffe.testimonial.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <form action="{{ route('admin.caffe.testimonial.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('name') border-red-500 @enderror"
                                value="{{ old('name', $testimonial->name) }}">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Jabatan/Peran
                                (Opsional)</label>
                            <input type="text" name="role" id="role"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('role') border-red-500 @enderror"
                                value="{{ old('role', $testimonial->role) }}">
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating
                                (Opsional)</label>
                            <select name="rating" id="rating"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('rating') border-red-500 @enderror">
                                <option value="">Tidak ada rating</option>
                                <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5
                                    Bintang ★★★★★</option>
                                <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4
                                    Bintang ★★★★☆</option>
                                <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3
                                    Bintang ★★★☆☆</option>
                                <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2
                                    Bintang ★★☆☆☆</option>
                                <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1
                                    Bintang ★☆☆☆☆</option>
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Avatar/Foto
                                (Opsional)</label>
                            <input type="file" name="avatar" id="avatar"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('avatar') border-red-500 @enderror">
                            @error('avatar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @if ($testimonial->avatar)
                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-700 mb-2">Avatar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                alt="Avatar {{ $testimonial->name }}"
                                class="w-24 h-24 object-cover rounded-full shadow-sm border">
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="quote" class="block text-sm font-medium text-gray-700 mb-1">Kutipan Testimoni</label>
                        <textarea name="quote" id="quote" rows="5"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cafe-accent @error('quote') border-red-500 @enderror">{{ old('quote', $testimonial->quote) }}</textarea>
                        @error('quote')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_visible" id="is_visible" value="1"
                                class="rounded border-gray-300 text-cafe-dark focus:ring-cafe-accent"
                                {{ old('is_visible', $testimonial->is_visible) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Tampilkan testimoni ini di website</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-cafe-dark text-white px-6 py-2 rounded-lg font-semibold hover:bg-cafe-accent transition-colors duration-200">
                            Perbarui Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
@endsection
