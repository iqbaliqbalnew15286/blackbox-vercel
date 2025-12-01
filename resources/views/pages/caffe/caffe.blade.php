@extends('layouts.caffe')

@section('title', 'Blackbox - Home')

{{-- Menambahkan custom CSS untuk elemen biru dan efek kaca (glass effect) --}}
@push('styles')
    <style>
        /* Mengubah warna Swiper Pagination menjadi biru */
        .swiper-pagination-bullet.bg-white\/50.w-2.h-2.rounded-full.mx-1.inline-block.cursor-pointer.transition:not(.swiper-pagination-bullet-active) {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .swiper-pagination-bullet-active {
            background-color: #3b82f6 !important;
            /* Biru 500 */
            width: 12px !important;
            height: 12px !important;
        }

        /* Glass Effect Card */
        .glass-card {
            background-color: rgba(18, 18, 18, 0.7);
            /* Background gelap transparan */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        /* Mengatasi z-index navigasi Swiper agar muncul di atas konten */
        .swiper-button-next,
        .swiper-button-prev {
            color: #3b82f6;
            /* Warna biru untuk navigasi */
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        /* Memastikan Swiper Slides memiliki tinggi yang seragam */
        .swiper-slide {
            height: auto;
        }
    </style>
@endpush

@section('content')

    {{-- HERO SECTION --}}
    <section class="relative min-h-[90vh] flex items-center pt-24 pb-16 bg-black">
        {{-- Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center opacity-20"
            style="background-image:url('{{ asset('assets/view1.jpg') }}')"></div>
        {{-- Overlay Gelap --}}
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

        {{-- KONTEN UTAMA: Grid 2 kolom (Teks & Visual) --}}
        <div class="relative z-10 container mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- KOLOM KIRI: Teks Profil --}}
            <div class="text-white max-w-xl">
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-4">
                    <span class="text-blue-400">Blackbox</span> Café
                </h1>
                <p class="text-gray-300 mb-8 text-xl max-w-md border-l-4 border-blue-500 pl-4">
                    Tempat nongkrong bertema otomotif dengan kopi premium & suasana cozy. Ruang komunitas, kerja, dan
                    hangout.
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ url('/pages/caffe/menu') }}"
                        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold shadow-2xl shadow-blue-900/50 hover:bg-blue-700 hover:scale-[1.03] transition duration-300">
                        Jelajahi Menu
                    </a>
                    <a href="{{ url('/pages/caffe/gallery') }}"
                        class="inline-block text-white border border-white/30 px-8 py-3 rounded-full hover:bg-white/10 transition duration-300">
                        Lihat Gallery
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN: Visual (Foto Profil/Suasana Cafe) --}}
            <div class="hidden lg:block">
                <div
                    class="w-full h-96 rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/50 transform hover:scale-[1.01] transition duration-500 border-4 border-blue-500/50">
                    <img src="{{ asset('storage/assets/cafe-profile.jpg') }}"
                        onerror="this.onerror=null; this.src='{{ asset('assets/view1.jpg') }}';" alt="Suasana Blackbox Cafe"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- MENU FAVORIT SECTION (Menggunakan Swiper) --}}
    <section class="py-20 bg-[#070707] text-white">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="flex justify-between items-end mb-10 border-b border-gray-800 pb-4">
                <h2 class="text-4xl font-extrabold flex items-center">
                    <i class="fa-solid fa-fire text-3xl text-blue-500 mr-4"></i> Menu Favorit Kami
                </h2>
                <a href="{{ url('/pages/caffe/menu') }}"
                    class="text-sm px-6 py-2 rounded-full border border-blue-500 text-blue-400 hover:bg-blue-600/20 transition font-semibold hidden md:inline-block">
                    Lihat Semua Menu
                </a>
            </div>

            {{-- SWIPER CONTAINER UNTUK MENU --}}
            <div class="swiper menuSwiper">
                <div class="swiper-wrapper py-4"> {{-- Tambahkan padding vertikal agar navigasi tidak terpotong --}}
                    @forelse ($favoriteMenu as $fav)
                        <div class="swiper-slide h-full"> {{-- Tambahkan h-full di swiper-slide --}}
                            <div class="h-full">
                                <div
                                    class="bg-[#1a1a1a] rounded-xl overflow-hidden shadow-xl h-full flex flex-col transform hover:shadow-2xl hover:border-blue-500/50 transition duration-300 border border-[#222]">
                                    <div class="relative">
                                        {{-- FOTO menu di sini --}}
                                        <img src="{{ asset('storage/' . ($fav->photo ?? 'assets/placeholder-menu.jpg')) }}"
                                            alt="{{ $fav->name }}" class="w-full h-64 object-cover">
                                        {{-- Kategori di sudut --}}
                                        <span
                                            class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">{{ $fav->category ?? 'Specialty' }}</span>
                                    </div>
                                    <div class="p-5 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h4 class="font-bold text-xl text-white">{{ $fav->name }}</h4>
                                            <p class="text-sm text-gray-400 mt-1">
                                                {{ $fav->description ?? 'Deskripsi singkat menu premium.' }}</p>
                                        </div>
                                        <div class="mt-4 flex items-center justify-between pt-4 border-t border-gray-800">
                                            <span class="text-blue-400 text-2xl font-extrabold">Rp
                                                {{ number_format($fav->price ?? 0, 0, ',', '.') }}</span>
                                            <a href="{{ url('/pages/caffe/menu') }}"
                                                class="text-sm bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 transition">Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide w-full">
                            <p class="text-gray-400 p-8 bg-[#1a1a1a] rounded-xl text-center">Menu favorit belum tersedia
                                saat ini.</p>
                        </div>
                    @endforelse
                </div>
                {{-- Navigation --}}
                <div class="swiper-button-next text-blue-500"></div>
                <div class="swiper-button-prev text-blue-500"></div>
                {{-- Pagination --}}
                <div class="swiper-pagination mt-6"></div>
            </div>

            {{-- Tombol Lihat Semua Menu --}}
            @if (count($favoriteMenu) > 0)
                <div class="text-center mt-12">
                    <a href="{{ url('/pages/caffe/menu') }}"
                        class="inline-block text-base px-8 py-3 rounded-full border border-blue-500 text-blue-400 hover:bg-blue-600/20 transition font-semibold">
                        Lihat Semua Menu
                    </a>
                </div>
            @endif

        </div>
    </section>

    ---
    {{-- TESTIMONIALS SECTION --}}
    <section class="py-20 bg-black text-white">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-4xl font-extrabold text-center mb-16">Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- MENGHILANGKAN ->take(3) agar semua ulasan tampil --}}
                @forelse ($testimonials as $testimonial)
                    <div
                        class="glass-card p-8 rounded-2xl shadow-2xl border border-blue-500/20 flex flex-col justify-between h-full hover:shadow-blue-900/50 transition duration-300">
                        <i class="fa-solid fa-quote-left text-4xl text-blue-500/50 mb-6"></i>
                        <p class="text-gray-300 italic mb-8 flex-grow text-lg leading-relaxed">"{{ $testimonial->quote }}"
                        </p>
                        <div class="flex items-center pt-4 border-t border-gray-800">
                            <img src="{{ asset('storage/' . ($testimonial->photo ?? 'assets/placeholder-profile.jpg')) }}"
                                alt="{{ $testimonial->name }}"
                                class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-blue-400">
                            <div>
                                <p class="font-bold text-white text-lg">{{ $testimonial->name }}</p>
                                <p class="text-sm text-gray-500">{{ $testimonial->title }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500 text-xl">Belum ada ulasan dari pelanggan.</p>
                @endforelse
            </div>
        </div>
    </section>

    ---
    {{-- ABOUT SECTION --}}
    <section class="py-20 bg-[#070707] text-white">
        <div class="container mx-auto px-6 lg:px-12 text-center max-w-5xl">
            <h2 class="text-4xl font-extrabold mb-4">Tentang Kami</h2>
            <p class="text-gray-300 mb-8 text-lg">Blackbox Café lahir dari perpaduan unik antara passion otomotif dan
                kecintaan akan kopi berkualitas. Kami bukan hanya sekadar tempat ngopi, tapi ruang nyaman yang diciptakan
                khusus untuk komunitas berkumpul, bekerja, atau sekadar menikmati suasana santai.</p>
            <a href="{{ url('/pages/caffe/ourstory') }}"
                class="inline-block px-8 py-3 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 transition duration-300">Baca
                Kisah Selengkapnya</a>
        </div>
    </section>

    ---
    {{-- TEAM SECTION --}}
    <section class="py-20 bg-black text-white">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-4xl font-extrabold text-center mb-12">Tim Kami</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                {{-- MENGHILANGKAN ->take(4) agar semua anggota tim tampil --}}
                @forelse ($ourteams as $team)
                    <div
                        class="text-center bg-[#1a1a1a] p-6 rounded-2xl shadow-xl border border-[#222] transition duration-300 hover:scale-[1.02] hover:border-blue-400/50">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden shadow-2xl mb-4 border-4 border-blue-400/30">
                            <img src="{{ asset('storage/' . ($team->photo ?? 'assets/placeholder-profile.jpg')) }}"
                                class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        </div>
                        <h4 class="mt-4 text-xl font-bold">{{ $team->name }}</h4>
                        <p class="text-base text-blue-400">{{ $team->position }}</p>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-500 text-xl">Belum ada anggota tim yang terdaftar.</p>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/pages/caffe/ourteam') }}"
                    class="px-8 py-3 rounded-full border border-white/30 text-white hover:bg-white/10 transition">Lihat
                    Semua Tim</a>
            </div>
        </div>
    </section>

    ---
    {{-- GALLERY SECTION (Menggunakan Swiper) --}}
    <section class="py-20 bg-[#070707] text-white">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-4xl font-extrabold text-center mb-12">Suasana Café</h2>
            {{-- SWIPER CONTAINER UNTUK GALLERY --}}
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    @forelse ($galleryPreview as $img)
                        <div class="swiper-slide">
                            <a href="{{ url('/pages/caffe/gallery') }}"
                                class="block rounded-xl overflow-hidden group glass-card border border-blue-500/20">
                                <img src="{{ asset('storage/' . ($img->image_path ?? 'assets/placeholder-gallery.jpg')) }}"
                                    alt="{{ $img->name ?? 'Gallery Image' }}"
                                    class="w-full h-56 object-cover group-hover:scale-105 transition duration-500 rounded-xl opacity-90 group-hover:opacity-100 shadow-lg">
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-center text-gray-400 text-lg">Belum ada gambar gallery.</p>
                        </div>
                    @endforelse
                </div>
                {{-- Navigation --}}
                <div class="swiper-button-next text-blue-500"></div>
                <div class="swiper-button-prev text-blue-500"></div>
                {{-- Pagination --}}
                <div class="swiper-pagination mt-6"></div>
            </div>

            @if (count($galleryPreview) > 0)
                <div class="text-center mt-12">
                    <a href="{{ url('/pages/caffe/gallery') }}"
                        class="inline-block px-10 py-4 rounded-full bg-blue-600 text-white font-semibold shadow-2xl hover:bg-blue-700 transition">Lihat
                        Gallery Lengkap</a>
                </div>
            @endif
        </div>
    </section>

    ---
    {{-- CTA/RESERVASI SECTION --}}
    <section class="py-16 bg-gradient-to-r from-black to-blue-900 text-white border-t border-white/10">
        <div class="container mx-auto px-6 lg:px-12 text-center">
            <h3 class="text-3xl font-bold mb-4">Siap Nongkrong di Blackbox Café?</h3>
            <p class="text-gray-300 mb-8 text-lg">Kunjungi kami hari ini! Kami buka setiap hari dengan suasana cozy, kopi
                premium, dan tempat nyaman untuk komunitas otomotif Anda.</p>
            <a href="{{ url('/reservasi') }}"
                class="inline-block px-8 py-4 rounded-full bg-white text-black text-lg font-semibold shadow-2xl hover:bg-gray-200 transition">Pesan
                Sekarang</a>
        </div>
    </section>

    {{-- SCROLL TO TOP BUTTON --}}
    <button id="scrollToTopBtn"
        class="fixed bottom-5 right-5 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-300 z-50"
        style="display: none;">
        <i class="fas fa-utensils"></i>
    </button>

@endsection

{{-- PUSH SCRIPTS UNTUK INISIALISASI SWIPER --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah Swiper terdefinisi (memastikan Anda sudah memasukkan library JS Swiper di layout)
            if (typeof Swiper !== 'undefined') {

                // 1. INISIALISASI MENU SWIPER
                const menuSwiper = new Swiper('.menuSwiper', {
                    // Konfigurasi umum
                    loop: false, // Set false agar tidak mengulang tanpa batas
                    spaceBetween: 32, // Jarak antar slide (item menu)
                    grabCursor: true,

                    // Tampilan Slide per View (Responsive)
                    slidesPerView: 1,
                    breakpoints: {
                        640: { // Mobile
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        1024: { // Desktop
                            slidesPerView: 4,
                            spaceBetween: 30
                        }
                    },

                    // Navigasi (Panah)
                    navigation: {
                        nextEl: '.menuSwiper .swiper-button-next',
                        prevEl: '.menuSwiper .swiper-button-prev',
                    },

                    // Pagination (Titik-titik di bawah)
                    pagination: {
                        el: '.menuSwiper .swiper-pagination',
                        clickable: true,
                    },
                });

                // 2. INISIALISASI GALLERY SWIPER
                const gallerySwiper = new Swiper('.gallerySwiper', {
                    // Konfigurasi umum
                    loop: true, // Set true agar galeri bisa berputar terus menerus
                    centeredSlides: true,
                    spaceBetween: 16,
                    grabCursor: true,

                    // Tampilan Slide per View (Responsive)
                    slidesPerView: 1.5, // Menampilkan 1.5 gambar di mobile
                    breakpoints: {
                        768: { // Tablet
                            slidesPerView: 3,
                            spaceBetween: 24
                        },
                        1024: { // Desktop
                            slidesPerView: 4,
                            spaceBetween: 24
                        }
                    },

                    // Navigasi (Panah)
                    navigation: {
                        nextEl: '.gallerySwiper .swiper-button-next',
                        prevEl: '.gallerySwiper .swiper-button-prev',
                    },

                    // Pagination (Titik-titik di bawah)
                    pagination: {
                        el: '.gallerySwiper .swiper-pagination',
                        clickable: true,
                    },

                    // Fitur Autoplay agar geser otomatis
                    autoplay: {
                        delay: 4000, // 4 detik
                        disableOnInteraction: false, // Lanjut jalan walau di-swipe manual
                    },
                });
            } else {
                console.error(
                    'Swiper library is not loaded. Please include Swiper CSS and JS in your layout file.');
            }

            // SCROLL TO TOP BUTTON FUNCTIONALITY
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');

            // Show/hide button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) { // Show after scrolling 300px
                    scrollToTopBtn.style.display = 'block';
                } else {
                    scrollToTopBtn.style.display = 'none';
                }
            });

            // Scroll to top when button is clicked
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Smooth scroll
                });
            });
        });
    </script>
@endpush
