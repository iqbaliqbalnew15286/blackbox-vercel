<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Blackbox Café & Community')</title>

    {{-- Favicon (Pastikan path ke file blackbox.png benar) --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/blackbox.png') }}">

    {{-- Tailwind CDN (Dipanggil pertama agar class bisa digunakan) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Swiper CSS & JS (Kritis untuk slider) --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    {{-- Font Awesome (v6.7.2) --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Subtle Underline Nav (Diperbarui dengan aksen Biru) */
        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding-bottom: 6px;
            text-decoration: none;
            color: #d1d5db;
            /* Default gray-300 */
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background: #3b82f6;
            /* Biru 500 */
            transition: width .3s ease, background .3s ease;
        }

        .nav-link.active::after,
        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: #60a5fa;
            /* Biru 400 untuk link aktif */
            font-weight: 600;
            /* Semi-bold untuk link aktif */
        }

        .nav-link.active::after {
            background: #60a5fa;
            /* Biru 400 untuk garis aktif */
        }


        /* Glass Card Look (Lebih gelap dan tegas) */
        .glass-card {
            background-color: rgba(18, 18, 18, 0.7);
            /* Background gelap transparan */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.8);
            color: white;
        }

        /* Mobile Menu Button */
        #menu-btn {
            z-index: 101;
            position: relative;
        }

        .hamburger-line {
            display: block;
            width: 28px;
            height: 2px;
            background-color: white;
            transition: all .3s ease;
            transform-origin: center;
        }

        #menu-btn.open .hamburger-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        #menu-btn.open .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        #menu-btn.open .hamburger-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
    </style>
    @stack('styles')
</head>

<body class="bg-black text-white">

    {{-- ************************************************************* --}}
    {{-- * KONFIGURASI WHATSAPP & INSTAGRAM * --}}
    {{-- ************************************************************* --}}
    @php
        // Nomor WhatsApp tujuan (Ganti dengan nomor WA Anda: 6289502669582)
        $whatsappNumber = '6288707770310';
        // Username Instagram Anda
        $instagramUser = 'chivs89';

        // Pesan default saat pelanggan mengklik tombol "Pesan Sekarang"
        $whatsappMessage = "Halo Blackbox Café, saya ingin melakukan pemesanan dan menanyakan menu terbaru. Bisakah saya dibantu?";

        // Buat link WhatsApp yang di-encode
        $whatsappLink = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($whatsappMessage);
        // Buat link Instagram
        $instagramLink = 'https://www.instagram.com/' . $instagramUser;

        // Variabel untuk path aktif
        $currentPath = Request::path();
        $basePath = 'pages/caffe';
        $isActive = fn($path) => str_contains($currentPath, $path) || ($path === $basePath && $currentPath === $basePath);
    @endphp

    {{-- HEADER (Modern Glassmorphism Navbar) --}}
    <header class="sticky top-0 z-50">
        <nav class="w-full px-6 lg:px-12 py-4 flex items-center justify-between glass-card border-b border-white/20">
            <div class="flex items-center gap-3">
                <a href="{{ url('/pages/caffe') }}" class="flex items-center gap-3" aria-label="Blackbox Home">
                    <img src="{{ asset('assets/logo.jpg') }}"
                        class="w-10 h-10 object-contain rounded-lg shadow-lg border border-white/10"
                        alt="Blackbox Café Logo">
                    <div class="text-white">
                        <div class="font-extrabold text-xl leading-5">BLACKBOX</div>
                        <div class="text-xs opacity-70 -mt-1 tracking-wider">Café & Community</div>
                    </div>
                </a>
            </div>

            {{-- Desktop nav --}}
            <div class="hidden lg:flex items-center gap-8" role="navigation" aria-label="Main Navigation">

                {{-- BARU: Link ke Halaman Pilih Layanan Utama --}}
                <a href="{{ url('/') }}" class="nav-link text-sm font-semibold text-blue-300 hover:text-blue-200">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Pilih Layanan
                </a>

                <a href="{{ url($basePath) }}" class="nav-link text-sm @if($isActive($basePath)) active @endif">Home</a>

                {{-- About Dropdown (Glass Card Style) --}}
                <div class="relative group">
                    {{-- Tombol Dropdown --}}
                    <button
                        class="nav-link text-sm flex items-center gap-1.5 @if($isActive('ourstory') || $isActive('ourteam')) active @endif"
                        aria-expanded="false" aria-controls="about-menu">
                        About <i
                            class="fa-solid fa-chevron-down text-[10px] ml-1 transition-transform group-hover:rotate-180"></i>
                    </button>

                    {{-- Konten Dropdown (Perbaikan di sini) --}}
                    <div id="about-menu"
                        class="absolute top-full left-1/2 transform -translate-x-1/2 glass-card rounded-xl py-3 px-0 w-48 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-all duration-300 pt-0"
                        style="padding-top: 15px;" role="menu">

                        <div class="pb-3">
                            <a href="{{ url('/pages/caffe/ourstory') }}"
                                class="block px-5 py-2 text-sm text-gray-300 hover:text-white hover:bg-blue-600/20 transition rounded-lg mx-2"
                                role="menuitem">Our Story</a>
                            <a href="{{ url('/pages/caffe/ourteam') }}"
                                class="block px-5 py-2 text-sm text-gray-300 hover:text-white hover:bg-blue-600/20 transition rounded-lg mx-2"
                                role="menuitem">Our Team</a>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/pages/caffe/menu') }}" class="nav-link text-sm @if($isActive('menu')) active @endif">Menu</a>
                <a href="{{ url('/pages/caffe/gallery') }}"
                    class="nav-link text-sm @if($isActive('gallery')) active @endif">Gallery</a>
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-4">
                {{-- ******************************************** --}}
                {{-- * TOMBOL PESAN SEKARANG (Desktop) -> WA * --}}
                {{-- ******************************************** --}}
                <a href="{{ $whatsappLink }}" target="_blank"
                    class="hidden md:inline-block bg-blue-600 text-white px-5 py-2.5 rounded-full font-semibold shadow-lg shadow-blue-900/50 hover:bg-blue-700 hover:scale-[1.03] transition duration-300">
                    Pesan Sekarang <i class="fa-brands fa-whatsapp ml-1"></i>
                </a>

                {{-- mobile menu button --}}
                <button id="menu-btn" class="lg:hidden p-2" aria-label="Toggle mobile menu" aria-expanded="false"
                    aria-controls="mobile-nav">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line my-1"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </nav>
    </header>

    {{-- mobile nav slide (Glass Card Style) --}}
    <div id="mobile-backdrop"
        class="fixed inset-0 bg-black/80 z-40 hidden transition-opacity duration-300 opacity-0"></div>
    <div id="mobile-nav"
        class="fixed top-0 right-0 w-[80vw] max-w-xs h-full glass-card z-50 transform translate-x-full transition-transform duration-300 shadow-2xl overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                <div class="text-white font-extrabold text-xl">NAVIGATION</div>
                {{-- Tombol close (diambil dari menu-btn) --}}
                <button id="close-mobile-btn" class="p-2 lg:hidden" aria-label="Close mobile menu">
                    <i class="fa-solid fa-xmark text-xl text-white"></i>
                </button>
            </div>

            {{-- BARU: Link ke Halaman Pilih Layanan Utama (Mobile) --}}
            <a href="{{ url('/') }}"
                class="block text-blue-400 font-bold mb-2 text-lg py-3 px-3 hover:bg-blue-600/20 rounded-lg border border-blue-400/50">
                <i class="fa-solid fa-arrow-left mr-2"></i> Pilih Layanan
            </a>

            <a href="{{ url('/pages/caffe') }}"
                class="block text-white font-semibold mb-2 text-lg py-3 px-3 hover:bg-blue-600/20 rounded-lg @if($isActive($basePath)) text-blue-400 @endif">Home</a>

            <div class="font-semibold text-blue-400/80 mb-1 mt-4 border-t border-white/10 pt-4">About</div>
            <a href="{{ url('/pages/caffe/ourstory') }}"
                class="block text-white py-2 pl-4 hover:bg-blue-600/10 rounded-lg @if($isActive('ourstory')) text-blue-300 font-medium @endif">Our
                Story</a>
            <a href="{{ url('/pages/caffe/ourteam') }}"
                class="block text-white py-2 pl-4 hover:bg-blue-600/10 rounded-lg @if($isActive('ourteam')) text-blue-300 font-medium @endif">Our
                Team</a>

            <a href="{{ url('/pages/caffe/menu') }}"
                class="block text-white font-semibold mt-4 text-lg py-3 px-3 hover:bg-blue-600/20 rounded-lg @if($isActive('menu')) text-blue-400 @endif">Menu</a>
            <a href="{{ url('/pages/caffe/gallery') }}"
                class="block text-white font-semibold text-lg py-3 px-3 hover:bg-blue-600/20 rounded-lg @if($isActive('gallery')) text-blue-400 @endif">Gallery</a>

            <div class="mt-8 border-t border-white/10 pt-4">
                {{-- ******************************************** --}}
                {{-- * TOMBOL PESAN SEKARANG (Mobile) -> WA * --}}
                {{-- ******************************************** --}}
                <a href="{{ $whatsappLink }}" target="_blank"
                    class="block bg-blue-600 text-white text-center py-3 rounded-full font-semibold shadow-lg shadow-blue-900/50 hover:bg-blue-700 transition">Pesan
                    Sekarang <i class="fa-brands fa-whatsapp ml-1"></i></a>
            </div>
        </div>
    </div>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-[#050505] text-gray-300 py-12 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                {{-- Logo and Mission --}}
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <img src="{{ asset('assets/logo.jpg') }}" class="w-8 h-8 object-contain rounded-md"
                            alt="Blackbox Footer Logo">
                        <div class="text-white font-bold text-lg">BLACKBOX</div>
                    </div>
                    <p class="text-sm text-gray-400 max-w-xs">Ride by passion, fueled by Blackbox. Tempat berkumpulnya
                        penikmat kopi & komunitas otomotif.</p>
                    <div class="flex gap-4 mt-4">
                        {{-- ******************************************** --}}
                        {{-- * LINK INSTAGRAM DIPERBARUI * --}}
                        {{-- ******************************************** --}}
                        <a href="{{ $instagramLink }}" target="_blank" class="text-gray-400 hover:text-blue-400 transition"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i
                                class="fa-brands fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i
                                class="fa-brands fa-twitter text-xl"></i></a>
                    </div>
                </div>

                {{-- Navigation and Contact Links --}}
                <div class="grid grid-cols-2 gap-10 text-sm text-gray-400">
                    <div>
                        <h4 class="text-white font-semibold mb-3">Navigasi</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ url('/') }}" class="hover:text-blue-400 transition">Pilih Layanan</a></li>
                            <li><a href="{{ url('/pages/caffe') }}" class="hover:text-white transition">Home</a></li>
                            <li><a href="{{ url('/pages/caffe/menu') }}" class="hover:text-white transition">Menu</a></li>
                            <li><a href="{{ url('/pages/caffe/ourstory') }}" class="hover:text-white transition">Our
                                    Story</a></li>
                            <li><a href="{{ url('/pages/caffe/gallery') }}"
                                    class="hover:text-white transition">Gallery</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-3">Kontak & Lokasi</h4>
                        <div class="space-y-2">
                            <p class="text-sm flex items-start gap-2"><i
                                    class="fa-solid fa-location-dot mt-1 w-4 text-blue-400"></i> Jl. Raya Otomotif No.123,
                                Jakarta</p>
                            <p class="text-sm flex items-center gap-2"><i
                                    class="fa-solid fa-envelope w-4 text-blue-400"></i> info@blackbox.com</p>
                            <p class="text-sm flex items-center gap-2"><i
                                    class="fa-solid fa-phone w-4 text-blue-400"></i> +62 812 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center text-xs text-gray-500 border-t border-white/5 pt-5">
                &copy; {{ date('Y') }} Blackbox. All rights reserved. Design by Canvas
            </div>
        </div>
    </footer>

    {{-- SCRIPTS (Tidak ada perubahan pada JavaScript) --}}
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeMobileBtn = document.getElementById('close-mobile-btn');
        const mobileNav = document.getElementById('mobile-nav');
        const mobileBackdrop = document.getElementById('mobile-backdrop');

        const openMenu = () => {
            menuBtn.classList.add('open');
            mobileNav.classList.remove('translate-x-full');
            menuBtn.setAttribute('aria-expanded', 'true');
            mobileBackdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => mobileBackdrop.classList.add('opacity-100'), 10);
        }

        const closeMenu = () => {
            menuBtn.classList.remove('open');
            mobileNav.classList.add('translate-x-full');
            menuBtn.setAttribute('aria-expanded', 'false');
            mobileBackdrop.classList.remove('opacity-100');
            document.body.style.overflow = 'auto';
            setTimeout(() => mobileBackdrop.classList.add('hidden'), 300);
        }

        menuBtn.addEventListener('click', openMenu);
        closeMobileBtn.addEventListener('click', closeMenu);
        mobileBackdrop.addEventListener('click', closeMenu);

        // Menutup menu jika ukuran layar berubah (dari mobile ke desktop)
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && mobileNav.classList.contains('translate-x-0')) {
                closeMenu();
            }
        });
    </script>

    {{-- Push custom scripts from individual pages --}}
    @stack('scripts')
</body>

</html>
