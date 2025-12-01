@extends('layouts.caffe')

@section('content')
@section('title', 'Our Team - Warung Garage House')
<div class="min-h-screen bg-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Team</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Meet the passionate team behind Warung Garage House. We're dedicated to serving you the best coffee and
                creating unforgettable experiences.
            </p>
        </div>

        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($ourteams as $ourteam)
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Photo -->
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if ($ourteam->photo)
                            <img src="{{ asset('storage/' . $ourteam->photo) }}" alt="{{ $ourteam->name }}"
                                class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-user text-6xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $ourteam->name }}</h3>
                        <p class="text-blue-600 font-medium mb-2">{{ $ourteam->position }}</p>
                        @if ($ourteam->subject)
                            <p class="text-gray-600 text-sm mb-3">{{ $ourteam->subject }}</p>
                        @endif
                        @if ($ourteam->category)
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                                {{ $ourteam->category }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Team Members Yet</h3>
                    <p class="text-gray-500">Our team members will be displayed here soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
