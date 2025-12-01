@extends('layouts.admin-app')

@section('content')
    <div class="main-content flex-1 p-4 sm:p-6">
        <div class="bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">Detail Anggota Tim</h1>
                <a href="{{ route('admin.ourteam.index') }}"
                    class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors duration-200">
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Foto -->
                <div class="md:col-span-2 flex justify-center">
                    @if ($ourteam->photo)
                        <img src="{{ asset('storage/' . $ourteam->photo) }}" alt="{{ $ourteam->name }}"
                            class="w-48 h-48 object-cover rounded-lg shadow-md">
                    @else
                        <div class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-6xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                    <p class="text-lg font-semibold text-white">{{ $ourteam->name }}</p>
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jabatan</label>
                    <p class="text-lg text-white">{{ $ourteam->position }}</p>
                </div>


                <!-- Tanggal Dibuat -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal Dibuat</label>
                    <p class="text-lg text-white">{{ $ourteam->created_at->format('d M Y') }}</p>
                </div>

                <!-- Tanggal Diupdate -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Terakhir Diupdate</label>
                    <p class="text-lg text-white">{{ $ourteam->updated_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.ourteam.edit', $ourteam->id) }}"
                    class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors duration-200">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
