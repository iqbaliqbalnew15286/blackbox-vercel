@extends('layouts.admin-app')

@section('content')
    <div class="main-content flex-1 p-4 sm:p-6">
        <div class="bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 border border-gray-700">
            <h1 class="text-2xl font-bold text-white mb-6">Edit Anggota Tim</h1>

            @if ($errors->any())
                <div class="bg-red-900 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-lg shadow-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ourteam.update', $ourteam->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $ourteam->name) }}"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                            required>
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-300 mb-2">Jabatan</label>
                        <input type="text" id="position" name="position"
                            value="{{ old('position', $ourteam->position) }}"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                            required>
                    </div>



                    <!-- Foto -->
                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-medium text-gray-300 mb-2">Foto</label>
                        @if ($ourteam->photo)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $ourteam->photo) }}" alt="{{ $ourteam->name }}"
                                    class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                        <input type="file" id="photo" name="photo" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        <p class="text-sm text-gray-400 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak
                            ingin mengubah foto.</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.ourteam.index') }}"
                        class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors duration-200">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
