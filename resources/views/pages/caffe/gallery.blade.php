@extends('layouts.caffe')

@section('title', 'Blackbox - Gallery')

@section('content')

<section class="min-h-screen pt-20 pb-24 bg-black text-white">
    <div class="container mx-auto px-6 lg:px-12">

        {{-- HEADING --}}
        <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-4 tracking-tight">
             Our Gallery
        </h1>

        <p class="text-center text-gray-400 mb-12 max-w-3xl mx-auto text-lg">
            Jelajahi momen-momen terbaik yang kami abadikan: suasana, hidangan, dan komunitas di Blackbox Café.
        </p>

        {{-- GALLERY GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse ($images as $image)
                <div class="group relative rounded-xl overflow-hidden shadow-xl glass-card
                            transition-all duration-300 transform hover:scale-[1.03] hover:border-white/20">

                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                        alt="{{ $image->name ?? 'Gallery Image' }}"
                        class="w-full h-56 md:h-64 object-cover transform group-hover:scale-110
                                transition duration-500 ease-out brightness-90 group-hover:brightness-100">

                    {{-- Overlay & Caption --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent
                                opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">

                        {{-- Caption --}}
                        <h3 class="text-white font-bold text-lg tracking-wide border-l-2 border-white/50 pl-3">
                            {{ $image->name ?? 'Untitled Image' }}
                        </h3>
                    </div>

                </div>

            @empty
                <div class="col-span-full text-center py-20 bg-[#0f0f0f] rounded-xl border border-white/10">
                    <i class="fa-regular fa-image text-5xl text-gray-700 mb-4"></i>
                    <p class="text-gray-400 text-lg">
                        Maaf, saat ini belum ada foto yang tersedia di galeri.
                    </p>
                </div>
            @endforelse

        </div>

    </div>
</section>

@endsection
