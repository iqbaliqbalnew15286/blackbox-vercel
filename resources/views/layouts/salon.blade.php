<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Elegance Salon & Spa')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS & Font Awesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Global Styles --}}
    <style>
        :root {
            --salon-pink: #db2780;
            /* Deep Magenta (Aksen Kuat) */
            --dark-accent: #2d1b69;
            /* Deep Indigo/Purple */
            --cream: #fef7f0;
            /* Warm Cream Background (Body Background) */
        }

        .accent-rose {
            color: var(--salon-pink);
        }

        .bg-dark-accent {
            background-color: var(--dark-accent);
        }

        .bg-cream {
            background-color: var(--cream);
        }

        .text-dark-accent {
            color: var(--dark-accent);
        }

        .text-salon-pink {
            color: var(--salon-pink);
        }

        /* Utility untuk warna Pink Utama */
        .bg-salon-pink {
            background-color: var(--salon-pink);
        }

        .font-elegant {
            font-family: 'Playfair Display', serif;
        }

        /* Hover effect untuk tombol booking yang lebih dramatis */
        .btn-booking {
            transition: all 0.3s ease;
        }

        .btn-booking:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(219, 39, 128, 0.5); /* Meningkatkan shadow untuk dramatis */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream);
            color: #333;
        }

        /* Perubahan Navbar: Putih, Sticky, Shadow Elegan */
        .header-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: rgba(255, 255, 255, 0.98); /* Lebih solid */
            backdrop-filter: blur(8px); /* Meningkatkan blur */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); /* Shadow lebih terlihat dan elegan */
        }

        /* Nav Link Hover Elegan */
        .nav-link-elegant {
            position: relative;
            transition: color 0.3s ease;
            padding-bottom: 3px;
        }

        /* Barisan di bawah link */
        .nav-link-elegant::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--salon-pink);
            transition: width 0.3s ease; /* Transisi hanya pada lebar */
        }

        .nav-link-elegant:hover::after,
        .nav-link-elegant.active::after {
            width: 100%;
        }
        .nav-link-elegant.active {
            color: var(--salon-pink);
            font-weight: 600;
        }

        /* Mengganti ikon close pada Mobile Menu agar terlihat lebih jelas */
        .mobile-menu-icon {
            transition: transform 0.3s ease;
        }
    </style>

    {{-- Custom Styles from Child Views --}}
    @stack('styles')
</head>

<body>
    {{-- Header (Navbar) --}}
    <header class="header-sticky">
        <nav class="container mx-auto px-6 lg:px-12 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ url('/salon') }}" class="flex items-center space-x-3">
                    {{-- Logo menggunakan asset yang diunggah jika tersedia, jika tidak menggunakan placeholder --}}
                    {{--

[Image of Elegance Salon logo icon]
 --}}
                    <img src="{{ asset('image_2c2fa5.png') }}" alt="Elegance Salon"
                        class="h-10 w-10 rounded-full object-cover shadow-md border border-gray-100">
                    <span class="font-elegant text-2xl font-bold text-dark-accent">Elegance Salon</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                    @php
                        $currentPath = Request::path();
                        // Perbaikan logika untuk home: / atau salon
                        $isHome = $currentPath === 'salon' || $currentPath === '/';
                        $isLayanan = str_contains($currentPath, 'layanan');
                        $isGallery = str_contains($currentPath, 'gallery');
                        $isContact = str_contains($currentPath, 'contact');
                    @endphp

                    {{-- BARU: Link ke Halaman Pilih Layanan Utama --}}
                    <a href="{{ url('/') }}"
                        class="font-semibold text-salon-pink border border-salon-pink px-4 py-2 rounded-full text-sm hover:bg-salon-pink hover:text-white transition duration-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left text-xs"></i> Pilih Layanan
                    </a>

                    {{-- Teks menu menggunakan Dark Accent, hover menjadi Deep Pink --}}
                    <a href="{{ url('/salon') }}"
                        class="nav-link-elegant text-dark-accent font-semibold @if($isHome) active @endif">Home</a>
                    <a href="{{ url('/salon/layanan') }}"
                        class="nav-link-elegant text-dark-accent font-semibold @if($isLayanan) active @endif">Layanan</a>
                    <a href="{{ url('/salon/gallery') }}"
                        class="nav-link-elegant text-dark-accent font-semibold @if($isGallery) active @endif">Gallery</a>
                    {{-- Penambahan Link Team di Desktop Menu --}}
                    <a href="{{ url('/salon/contact') }}"
                        class="nav-link-elegant text-dark-accent font-semibold @if($isContact) active @endif">Contact</a>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-dark-accent focus:outline-none">
                        <i class="fas fa-bars text-xl mobile-menu-icon"></i>
                    </button>
                </div>
            </div>
        </nav>

        {{-- Mobile Menu Dropdown (Putih Bersih) --}}
        <div id="mobile-menu-dropdown" class="hidden md:hidden bg-white border-t border-salon-pink/20 shadow-lg">
            <div class="container mx-auto px-6 py-4 space-y-3">

                {{-- Link ke Halaman Pilih Layanan Utama (Mobile - Dark Accent) --}}
                <a href="{{ url('/') }}"
                    class="block text-white bg-dark-accent font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-dark-accent/90 transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Pilih Layanan Utama
                </a>

                <a href="{{ url('/salon') }}"
                    class="block text-dark-accent py-2 px-4 hover:bg-salon-pink/10 rounded-lg transition duration-300 @if($isHome) text-salon-pink font-semibold @endif">Home</a>
                <a href="{{ url('/salon/layanan') }}"
                    class="block text-dark-accent py-2 px-4 hover:bg-salon-pink/10 rounded-lg transition duration-300 @if($isLayanan) text-salon-pink font-semibold @endif">Layanan</a>
                <a href="{{ url('/salon/gallery') }}"
                    class="block text-dark-accent py-2 px-4 hover:bg-salon-pink/10 rounded-lg transition duration-300 @if($isGallery) text-salon-pink font-semibold @endif">Gallery</a>
                <a href="{{ url('/salon/contact') }}"
                    class="block text-dark-accent py-2 px-4 hover:bg-salon-pink/10 rounded-lg transition duration-300 @if($isContact) text-salon-pink font-semibold @endif">Contact</a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer - Deep Purple/Indigo --}}
    <footer class="bg-dark-accent text-white py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                {{-- Kolom 1: Logo & Deskripsi --}}
                <div class="md:col-span-1">
                    <h3 class="font-elegant text-3xl font-bold mb-3 text-salon-pink">Elegance</h3>
                    <p class="text-white/80 text-sm mb-4">Tempat perawatan kecantikan terpercaya dengan layanan premium untuk semua kebutuhan Anda.</p>
                    <a href="{{ url('/salon/layanan') }}" class="btn-booking inline-block bg-salon-pink text-white px-6 py-3 rounded-full font-bold text-sm shadow-lg hover:shadow-xl">
                        Booking Sekarang <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                {{-- Kolom 2: Navigasi Cepat --}}
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-4 text-salon-pink">Quick Links</h4>
                    <ul class="space-y-3 text-white/80 text-sm">
                        <li><a href="{{ url('/salon') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ url('/salon/layanan') }}" class="hover:text-white transition">Layanan & Harga</a></li>
                        <li><a href="{{ url('/salon/gallery') }}" class="hover:text-white transition">Gallery</a></li>
                        <li><a href="{{ url('/salon/team') }}" class="hover:text-white transition">Our Team</a></li>
                        <li><a href="{{ url('/salon/contact') }}" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Layanan Kami --}}
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-4 text-salon-pink">Layanan Utama</h4>
                    <ul class="space-y-3 text-white/80 text-sm">
                        {{-- Ikon diubah menjadi white/80 agar tidak terlalu mencolok --}}
                        <li><i class="fas fa-cut mr-2 text-white/80"></i> Perawatan Rambut</li>
                        <li><i class="fas fa-spa mr-2 text-white/80"></i> Perawatan Wajah & Spa</li>
                        <li><i class="fas fa-hand-sparkles mr-2 text-white/80"></i> Manicure & Pedicure</li>
                        <li><i class="fas fa-eye mr-2 text-white/80"></i> Lash & Brow</li>
                    </ul>
                </div>

                {{-- Kolom 4: Kontak Kami --}}
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-4 text-salon-pink">Hubungi Kami</h4>
                    <div class="space-y-3 text-sm">
                        <p class="text-white/80"><i class="fas fa-phone mr-2 text-salon-pink"></i> +62 123 456 789</p>
                        <p class="text-white/80"><i class="fas fa-envelope mr-2 text-salon-pink"></i> info@elegancesalon.com</p>
                        <p class="text-white/80"><i class="fas fa-map-marker-alt mr-2 text-salon-pink"></i> Jl. Kecantikan No. 5, Jakarta</p>
                    </div>
                    {{-- Social Media Icons --}}
                    <div class="flex gap-4 mt-4">
                        <a href="#" class="text-white/60 hover:text-salon-pink transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-white/60 hover:text-salon-pink transition"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-white/60 hover:text-salon-pink transition"><i class="fab fa-whatsapp text-xl"></i></a>
                    </div>
                </div>

            </div>

            <div class="border-t border-white/10 mt-10 pt-5 text-center">
                <p class="text-white/60 text-xs">&copy; {{ date('Y') }} Elegance Salon & Spa. All rights reserved. | Powered by Canvas</p>
            </div>
        </div>
    </footer>

    {{-- Custom Scripts from Child Views --}}
    @stack('scripts')

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-button');
            const mobileMenuDropdown = document.getElementById('mobile-menu-dropdown');
            const mobileMenuIcon = mobileMenuBtn.querySelector('.mobile-menu-icon');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenuDropdown.classList.toggle('hidden');

                // Mengganti ikon hamburger menjadi close jika terbuka
                if (mobileMenuDropdown.classList.contains('hidden')) {
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                } else {
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-xmark');
                }
            });
        });
    </script>
</body>

</html>
