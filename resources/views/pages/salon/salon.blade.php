@extends('layouts.salon')

@section('title', 'Elegance Salon & Spa - Home')

{{-- Menambahkan Style khusus untuk halaman Home --}}
@push('styles')
    <style>
        /* Warna Kustom Berdasarkan Layout */
        .color-text-dark {
            color: #333;
        }

        /* Hero Section Background (Menggunakan gambar yang ada) */
        .hero-bg {
            /* MENGGUNAKAN FILE UPLOAD ANDA: image_2de6d3.jpg */
            /* Pastikan file ini berada di folder 'public' atau 'public/assets' */
            background-image: url('{{ asset('image_2de6d3.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        /* Style untuk tombol yang lebih elegan (override btn-booking) */
        .btn-hero {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .btn-hero:hover {
            transform: scale(1.05) translateY(-5px);
            /* Transformasi yang lebih dramatis */
            box-shadow: 0 20px 40px rgba(219, 39, 128, 0.6);
            /* Shadow yang lebih kuat */
        }

        /* Shadow yang lebih lembut dan berwarna pink/rose */
        .shadow-soft-pink {
            box-shadow: 0 5px 20px rgba(219, 39, 128, 0.15);
        }

        .hover-shadow-lg-pink:hover {
            box-shadow: 0 20px 35px rgba(219, 39, 128, 0.3);
        }

        /* Focus Ring Pink */
        .focus-ring-pink:focus {
            outline: none;
            box-shadow: 0 0 0 5px rgba(219, 39, 128, 0.5);
        }

        /* Menambahkan style khusus untuk teks besar di Hero */
        .hero-title-shadow {
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush

@section('content')

    {{-- 1. HERO SECTION (Dramatis & Elegan) --}}
    <section class="relative h-[95vh] flex items-center bg-cover bg-center hero-bg">
        {{-- Overlay Dark Accent (Deep Indigo) --}}
        <div class="absolute inset-0 bg-dark-accent/75"></div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10 text-white text-center">
            <p class="text-2xl font-semibold italic mb-3 text-accent-light tracking-widest uppercase">
                Welcome to Elegance
            </p>
            <h1 class="text-7xl md:text-9xl font-elegant font-bold mb-8 leading-tight hero-title-shadow">
                Elegance <span class="text-salon-pink">&</span> Style.
            </h1>
            <p class="text-xl mb-12 max-w-3xl mx-auto font-light text-gray-100">
                Rasakan relaksasi premium dan dapatkan transformasi yang menakjubkan. Kami memberikan perawatan dengan
                sentuhan profesional dan hasil yang menawan.
            </p>

            {{-- CTA Utama: Warna Pink Cerah/Salon Pink --}}
            <a href="{{ url('/salon/booking') }}"
                class="inline-block bg-salon-pink text-white px-12 py-4 rounded-full text-lg font-extrabold transition duration-300 shadow-xl focus-ring-pink btn-hero uppercase">
                Booking Janji Temu <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

    {{-- 2. FEATURED SERVICES (Kartu Rapi dengan Aksen Pink) --}}
    <section class="py-24 bg-cream">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-5xl font-elegant font-bold text-center mb-3 text-dark-accent">Perawatan Eksklusif</h2>
            <p class="text-center text-gray-500 mb-16 max-w-2xl mx-auto text-lg">Dirancang untuk memanjakan Anda dari ujung
                rambut
                hingga ujung kaki.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Memastikan $featuredServices ada dan merupakan array/collection --}}
                @forelse ($featuredServices as $service)
                    {{-- Card Services: Shadow Pink Lembut --}}
                    <a href="{{ url('/salon/layanan') }}"
                        class="group block bg-white rounded-2xl shadow-soft-pink hover-shadow-lg-pink overflow-hidden transition duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="h-60 overflow-hidden">
                            {{-- LOGIKA CMS DIJAGA --}}
                            <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                {{-- Nama Layanan --}}
                                <h3 class="text-2xl font-bold color-text-dark group-hover:text-salon-pink transition font-elegant leading-tight">
                                    {{ $service->name }}</h3>
                                {{-- Ikon --}}
                                <i class="fa-solid fa-spa text-3xl text-salon-pink ml-4"></i>
                            </div>
                            <p class="text-sm text-gray-500 mb-4 line-clamp-3">{{ $service->description }}</p>
                            {{-- Harga dengan Warna Dark Accent --}}
                            <div class="text-lg font-extrabold text-dark-accent border-t border-gray-100 pt-3 mt-3">
                                Rp
                                {{ number_format($service->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                @empty
                    {{-- Tampilkan Placeholder jika data kosong --}}
                    <div class="md:col-span-3 text-center py-10 text-gray-500">
                        <i class="fa-solid fa-face-sad-cry text-3xl mb-3 text-salon-pink"></i>
                        <p>Belum ada layanan unggulan yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-16">
                {{-- Tombol dengan Border Pink, Hover Background Dark Accent --}}
                <a href="{{ url('/salon/layanan') }}"
                    class="inline-block border-2 border-salon-pink text-salon-pink px-8 py-3 rounded-full font-semibold hover:bg-dark-accent hover:text-white transition duration-300 focus-ring-pink shadow-md text-lg">
                    Lihat Semua Layanan <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    ---

    {{-- 3. TESTIMONIALS SECTION (Warna Light Accent Pink) --}}
    <section class="py-24 bg-accent-light">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-5xl font-elegant font-bold text-center mb-3 text-dark-accent">Apa Kata Mereka?</h2>
            <p class="text-center text-dark-accent/80 mb-16 max-w-2xl mx-auto text-lg">Kepuasan pelanggan adalah prioritas kami.
                Simak ulasan dari para klien kami.</p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse ($testimonials as $testimonial)
                    <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-salon-pink">
                        {{-- Quote (Dark Accent Text) --}}
                        <blockquote
                            class="text-dark-accent text-xl italic leading-relaxed mb-6">
                            <i class="fa-solid fa-quote-left accent-rose mr-2 text-2xl opacity-70"></i>
                            "{{ $testimonial->quote }}"
                        </blockquote>

                        {{-- Rating Bintang (Pink) --}}
                        <div class="flex text-base accent-rose mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star @if($i >= $testimonial->rating) text-gray-300 @endif"></i>
                            @endfor
                        </div>

                        {{-- Author --}}
                        <div class="flex items-center mt-6 pt-4 border-t border-gray-100">
                            {{-- Menggunakan Image Placeholder atau Avatar Default --}}
                            <div
                                class="w-12 h-12 rounded-full bg-cream mr-3 flex items-center justify-center text-dark-accent font-bold text-xl border-2 border-salon-pink/50">
                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-dark-accent">{{ $testimonial->name }}</p>
                                <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Tampilkan Placeholder jika data kosong --}}
                    <div class="lg:col-span-2 text-center py-10 text-gray-500">
                        <i class="fa-solid fa-comments text-3xl mb-3 text-salon-pink"></i>
                        <p>Saat ini belum ada testimonial yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    ---

    {{-- 4. ABOUT/EXPERIENCE SECTION (Callout) - Warna Dark Accent Dominan --}}
    <section class="py-24 bg-dark-accent text-white">
        <div class="container mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Left: Image --}}
            <div class="lg:order-1">
                {{-- MENGGANTI PLACEHOLDER DENGAN ASUMSI GAMBAR LOKAL --}}
                <img src="{{ asset('assets/salon-interior-rose.jpg') }}" alt="Interior Salon Mewah"
                    class="rounded-3xl shadow-2xl border-4 border-accent-light transform hover:scale-[1.01] transition duration-500">
            </div>

            {{-- Right: Text --}}
            <div class="space-y-6 lg:order-2">
                <p class="text-xl font-semibold italic text-accent-light tracking-wider uppercase">Pengalaman Tak
                    Tertandingi</p>
                <h2 class="text-5xl font-elegant font-bold text-salon-pink">Tempat di Mana Kualitas Bertemu dengan Kenyamanan</h2>
                <p class="text-gray-300 text-lg">Kami percaya bahwa perawatan diri harus menjadi ritual. Elegance Salon &
                    Spa dirancang sebagai surga ketenangan, menawarkan suasana yang mewah, produk-produk terbaik, dan
                    perhatian yang detail pada setiap kunjungan Anda.</p>

                <ul class="space-y-3 text-gray-200 pt-4">
                    <li class="flex items-start text-lg"><i class="fa-solid fa-circle-check w-5 text-salon-pink mr-3 mt-1"></i>
                        Produk 100% Organik, Premium, dan Aman bagi Kulit Sensitif.</li>
                    <li class="flex items-start text-lg"><i class="fa-solid fa-circle-check w-5 text-salon-pink mr-3 mt-1"></i>
                        Ruangan Spa Privat & Terapis Bersertifikasi Internasional.</li>
                    <li class="flex items-start text-lg"><i class="fa-solid fa-circle-check w-5 text-salon-pink mr-3 mt-1"></i>
                        Konsultasi Gaya Personal Gratis Sebelum Setiap Layanan.</li>
                </ul>
            </div>
        </div>
    </section>

    ---

    {{-- 5. GALLERY SECTION --}}
    <section class="py-24 bg-cream">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-5xl font-elegant font-bold text-center mb-3 text-dark-accent">Our Gallery</h2>
            <p class="text-center text-gray-500 mb-8 max-w-2xl mx-auto text-lg">Hasil karya yang kami banggakan. Lihat sentuhan magis dari tim profesional kami.</p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @forelse ($galleryPreview as $image)
                    <a href="{{ url('/salon/gallery') }}"
                        class="block overflow-hidden rounded-xl shadow-soft-pink group border border-gray-200">
                        {{-- LOGIKA CMS DIJAGA --}}
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image"
                            class="w-full h-56 object-cover transition duration-500 group-hover:scale-110 group-hover:opacity-85">
                    </a>
                @empty
                    {{-- Tampilkan Placeholder jika data kosong --}}
                    <div class="sm:col-span-4 text-center py-10 text-gray-500">
                        <i class="fa-solid fa-camera-retro text-3xl mb-3 text-salon-pink"></i>
                        <p>Belum ada foto yang ditampilkan di galeri.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ url('/salon/gallery') }}"
                    class="inline-block border-2 border-salon-pink text-salon-pink px-8 py-3 rounded-full font-semibold hover:bg-dark-accent hover:text-white transition duration-300 focus-ring-pink shadow-md text-lg">
                    Gallery Lebih Lengkap <i class="fa-solid fa-arrow-right text-sm ml-1"></i>
                </a>
            </div>
        </div>
    </section>

    ---

    {{-- 6. FINAL CTA (Booking) --}}
    <section class="py-20 bg-dark-accent text-center">
        <h2 class="text-5xl font-elegant font-bold text-white mb-4">Waktu Anda untuk Bersinar</h2>
        <p class="text-gray-300 text-lg mb-8 max-w-xl mx-auto">Pesan janji temu sekarang dan mulailah perjalanan kecantikan
            Anda. Kami siap memanjakan Anda.</p>

        {{-- CTA Final: Warna Pink Cerah/Salon Pink --}}
        <a href="{{ url('/salon/booking') }}"
            class="bg-salon-pink text-white px-12 py-4 rounded-full text-xl font-extrabold transition duration-300 shadow-xl focus-ring-pink btn-hero uppercase">
            <i class="fa-regular fa-calendar-alt mr-2"></i> Booking Sekarang
        </a>
    </section>

@endsection

@push('scripts')
    {{-- Script untuk animasi atau carousel (jika ditambahkan) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika tambahan jika diperlukan, misalnya untuk carousel atau interaksi.
            console.log("Halaman Home Salon telah dimuat dengan tampilan modern Pink Aesthetic.");
        });
    </script>
@endpush
