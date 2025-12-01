@extends('layouts.salon')

@section('title', 'Elegance Salon & Spa - Galeri Karya')

@push('styles')
    {{-- CSS tambahan untuk memastikan filter button bekerja dengan class theme
Asumsi layouts.salon mendefinisikan dark-accent, accent-rose, dan cream --}}

    <style>
        .filter-button {
            transition: all 0.3s ease;
            cursor: pointer;
            /* Default state: Light BG (cream), Dark Text (dark-accent) /
    @apply bg-cream text-dark-accent border border-dark-accent/30;
    white-space: nowrap; / Mencegah tombol patah baris /
    }
    .filter-button.active {
    / Active state: Accent Pink BG (accent-rose), White Text /
    @apply bg-accent-rose text-white border-accent-rose;
    }
    .filter-button:not(.active):hover {
    / Hover state: Light BG dengan sedikit warna accent */
            @apply bg-accent-rose/20 text-dark-accent;
        }
    </style>
@endpush

@section('content')

    {{-- Hero Section Galeri --}}
    {{-- Menggunakan class custom dark-accent dan accent-rose --}}

    <section class="py-24 bg-dark-accent text-white text-center border-b-4 border-accent-rose shadow-lg">
        <div class="container mx-auto px-6 lg:px-12">
            <p class="text-lg font-medium text-accent-light tracking-widest mb-3">PORTFOLIO VISUAL</p>
            <h1 class="text-5xl font-extrabold mb-4">Inspirasi Kecantikan Kami</h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">Lihat hasil karya nyata yang dilakukan oleh tim ahli kami.</p>
        </div>
    </section>

    {{-- Galeri Foto --}}
    {{-- Menggunakan class custom cream --}}

    <section class="py-20 bg-cream">
        <div class="container mx-auto px-6 lg:px-12">

            {{-- Grid Galeri (Masonry-like structure) --}}
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach ($images as $image)
                    {{-- Data-category digunakan oleh JavaScript untuk filtering --}}
                    <div class="relative overflow-hidden rounded-xl shadow-xl group break-inside-avoid"
                        data-category="Gallery">
                        {{-- Image --}}
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->name }}"
                            class="w-full h-auto object-cover transition duration-500 group-hover:scale-105"
                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/E0E0E0/333333?text=Image+Not+Found';">

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 bg-dark-accent/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                            <div class="p-4 text-white">
                                <p class="text-sm font-light text-accent-rose">Gallery</p>
                                <h4 class="text-lg font-semibold">{{ $image->name }}</h4>
                                @if ($image->description)
                                    <p class="text-sm">{{ $image->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </section>

@endsection

@push('scripts')
    {{-- Script untuk animasi atau carousel (jika ditambahkan) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika tambahan jika diperlukan, misalnya untuk carousel atau interaksi.
            console.log("Halaman Gallery Salon telah dimuat dengan data dinamis.");
        });
    </script>
@endpush
