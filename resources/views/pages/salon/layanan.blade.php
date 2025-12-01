@extends('layouts.salon')

@section('title', 'Elegance Salon & Spa - Layanan Kami')

@section('content')

    {{-- Hero Section Layanan --}}
    <section class="py-24 bg-cream text-center border-b-4 border-salon-pink">
        <div class="container mx-auto px-6 lg:px-12">
            <p class="text-lg font-medium text-salon-pink tracking-widest mb-3">PILIHAN TERBAIK KAMI</p>
            {{-- Menggunakan text-dark-accent untuk kontras kuat --}}
            <h1 class="text-5xl font-extrabold text-dark-accent mb-4 font-elegant">Temukan Layanan Anda</h1>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">Kami menawarkan rangkaian perawatan dari ujung rambut hingga
                ujung kaki, dikerjakan oleh para ahli berpengalaman.</p>
        </div>
    </section>

    {{-- Daftar Layanan Lengkap --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 lg:px-12">
            {{-- Tentukan nomor WhatsApp Anda --}}
            @php
                $whatsappNumber = '6289502669582';
                $genericMessage = urlencode('Halo Elegance Salon, saya ingin membuat Janji Temu untuk perawatan umum.');
            @endphp

            @foreach ($services as $category => $items)
                <div class="mb-16">
                    {{-- Header Kategori (Pink Elegan) --}}
                    <div class="flex items-center mb-8 border-b-2 border-salon-pink/40 pb-2">
                        <i class="fa-solid fa-star text-3xl text-salon-pink mr-3"></i>
                        {{-- Menggunakan text-dark-accent untuk kontras kuat --}}
                        <h2 class="text-3xl font-bold text-dark-accent">{{ $category ?: 'Layanan Lainnya' }}</h2>
                    </div>

                    {{-- Item Layanan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($items as $item)
                            {{-- Pesan spesifik untuk item ini --}}
                            @php
                                $specificMessage = urlencode('Halo Elegance Salon, saya tertarik dengan layanan: ' . $item->name . '. Apakah saya bisa membuat janji temu?');
                                $whatsappLink = "https://wa.me/{$whatsappNumber}?text={$specificMessage}";
                            @endphp

                            <div
                                class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 overflow-hidden">
                                {{-- Foto Layanan --}}
                                @if (isset($item->photo))
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                                            class="w-full h-full object-cover transition duration-300 hover:scale-105"
                                            onerror="this.onerror=null;this.src='https://placehold.co/400x300/E0E0E0/333333?text=No+Image';">
                                    </div>
                                @else
                                    <div
                                        class="relative h-48 bg-gradient-to-br from-salon-pink/10 to-salon-pink/20 flex items-center justify-center">
                                        <i class="fa-solid fa-spa text-4xl text-salon-pink"></i>
                                    </div>
                                @endif

                                {{-- Konten Layanan --}}
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-dark-accent hover:text-salon-pink transition duration-300">
                                        {{ $item->name }}</h3>
                                    <p class="text-gray-500 mt-2 text-sm line-clamp-2">{{ $item->description }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="text-lg font-extrabold text-salon-pink">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </div>
                                        {{-- Link WA per Item --}}
                                        <a href="{{ $whatsappLink }}" target="_blank"
                                            class="inline-block bg-salon-pink text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-dark-accent transition duration-300">
                                            <i class="fa-brands fa-whatsapp mr-1"></i> Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- CTA Khusus (Pink Elegan) --}}
            {{-- Link WA untuk CTA umum --}}
            @php
                $whatsappLinkGeneral = "https://wa.me/{$whatsappNumber}?text={$genericMessage}";
            @endphp

            <div class="mt-16 text-center p-12 bg-salon-pink rounded-xl shadow-2xl border-4 border-white/50">
                <h3 class="text-3xl font-bold text-white mb-3">Siap Merasakan Perbedaannya?</h3>
                <p class="text-gray-100 mb-6">Pesan sesi Anda hari ini dan biarkan kami memanjakan Anda.</p>
                <a href="{{ $whatsappLinkGeneral }}" target="_blank"
                    class="inline-block bg-white text-dark-accent px-8 py-3 rounded-full text-lg font-bold hover:bg-dark-accent hover:text-white transition duration-300 shadow-xl">
                    <i class="fa-brands fa-whatsapp mr-2"></i> Pesan Sekarang
                </a>
            </div>
        </div>
    </section>

@endsection
