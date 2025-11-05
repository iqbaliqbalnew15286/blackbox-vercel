<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Warung Garage House')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image" href="{{ asset('assets/warghe.png') }}">
    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            /* Mencegah 'loncatan' saat scrollbar hilang ketika menu terbuka */
            overflow-x: hidden;
        }

        /* === DESKTOP STYLES (TIDAK BERUBAH) === */
        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 2px;
            transition: color .25s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.9);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .25s ease;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        .soft-shadow {
            box-shadow: 0 6px 18px rgba(10, 26, 60, 0.15);
        }

        .chev {
            font-size: 11px;
            margin-left: 4px;
        }

        .dropdown {
            opacity: 0;
            transform: translateY(3px);
            transition: all 0.25s ease;
            visibility: hidden;
            margin-top: 2px;
        }

        .group:hover .dropdown {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        /* === STYLING MOBILE MENU BARU (PROFESIONAL) === */

        /* 1. Tombol Hamburger Animasi */
        #menu-btn {
            z-index: 101;
            /* Pastikan tombol selalu di atas */
            position: relative;
            /* Diperlukan untuk z-index */
        }

        /* Garis-garis hamburger */
        .hamburger-line {
            display: block;
            width: 32px;
            /* 32px = w-8 di tailwind */
            height: 2px;
            /* 2px = h-0.5 di tailwind */
            background-color: #0a1a3c;
            transition: all 0.3s ease-in-out;
            transform-origin: center;
        }

        /* Animasi saat 'open' */
        #menu-btn.open .hamburger-line:nth-child(1) {
            transform: translateY(10px) rotate(45deg);
            /* 10px = 8px (space-y-2) + 2px (height) */
        }

        #menu-btn.open .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        #menu-btn.open .hamburger-line:nth-child(3) {
            transform: translateY(-10px) rotate(-45deg);
        }

        /* 2. Menu Link & Dropdown di dalam Off-Canvas */
        .mobile-link,
        .mobile-dropdown-toggle {
            display: block;
            color: white;
            padding: 16px 0;
            /* Padding lebih besar agar nyaman disentuh */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 16px;
            font-weight: 400;
            /* Sedikit lebih tebal */
            transition: background-color 0.2s ease, padding-left 0.2s ease;
        }

        .mobile-link:hover,
        .mobile-dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.05);
            padding-left: 8px;
            /* Efek hover keren */
        }

        /* Tombol dropdown */
        .mobile-dropdown-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        /* Panah chevron di menu mobile */
        .mobile-dropdown-toggle .chev-mobile {
            transition: transform 0.3s ease-in-out;
            font-size: 12px;
        }

        .mobile-dropdown-toggle.open .chev-mobile {
            transform: rotate(180deg);
        }

        /* 3. Animasi Accordion Dropdown (Smooth) */
        .mobile-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease-in-out;
            /* Animasi max-height */
            background-color: rgba(0, 0, 0, 0.2);
            padding-left: 15px;
        }

        /* Saat 'open', set max-height ke angka yang cukup besar */
        .mobile-dropdown.open {
            max-height: 500px;
        }

        .mobile-dropdown a {
            display: block;
            font-size: 15px;
            color: #eaeaea;
            /* Sedikit redup dari link utama */
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: padding-left 0.2s ease;
        }

        .mobile-dropdown a:hover {
            padding-left: 8px;
        }

        .mobile-dropdown a:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body class="bg-white">

    <header class="sticky top-0 z-50 ">
        <nav
            class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between bg-white lg:bg-transparent shadow-md lg:shadow-none">
            {{-- LOGO --}}
            <div class="flex items-center z-50">
                <img src="{{ asset('assets/warghe.png') }}" alt="Logo" class="w-[80px] h-[80px] object-contain">
            </div>

            {{-- DESKTOP NAV (TIDAK BERUBAH) --}}
            <div class="hidden lg:flex flex-1 justify-center">
                <div class="bg-[#0a1a3c] rounded-full px-10 py-5 min-w-[780px] flex items-center justify-between gap-[10px] soft-shadow"
                    style="backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); height: 50px;">

                    <ul class="flex flex-1 justify-evenly items-center text-white text-[15px] font-light tracking-wide">
                        <li><a href="#" class="nav-link">Home</a></li>
                        <li class="relative group">
                            <button class="nav-link flex items-center">
                                About
                                <i
                                    class="fa-solid fa-chevron-down chev transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            <ul
                                class="dropdown absolute left-0 top-full mt-3 w-44 bg-white rounded-md shadow-lg text-gray-700 py-2">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Our Story</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Our Team</a></li>
                            </ul>
                        </li>

                        <li class="relative group">
                            <button class="nav-link flex items-center">
                                Menu
                                <i
                                    class="fa-solid fa-chevron-down chev transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            <ul
                                class="dropdown absolute left-0 top-full mt-3 w-44 bg-white rounded-md shadow-lg text-gray-700 py-2">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Food</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Drinks</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Snacks</a></li>
                            </ul>
                        </li>
                        <li class="relative group">
                            <button class="nav-link flex items-center">
                                Gallery
                                <i
                                    class="fa-solid fa-chevron-down chev transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            <ul
                                class="dropdown absolute left-0 top-full mt-3 w-44 bg-white rounded-md shadow-lg text-gray-700 py-2">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Photos</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Videos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <a href="#"
                        class="bg-white text-[#0a1a3c] font-medium text-[14px] px-6 py-2 rounded-full flex items-center gap-2 shadow-sm transform transition-all hover:scale-[1.05]"
                        style="margin-right: -30px">
                        Pemesanan <i class="fa-solid fa-cart-shopping text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- CONTACT US (TIDAK BERUBAH) --}}
            <div class="hidden lg:flex justify-end">
                <a href="#"
                    class="bg-[#0a1a3c] text-white font-light text-[15px] px-8 py-2 rounded-full flex items-center gap-2 soft-shadow hover:bg-[#132b61] transition-all duration-200 transform hover:scale-[1.03]"
                    style="height: 45px;">
                    Contact Us
                </a>
            </div>

            {{-- MOBILE NAV TOGGLE (DIUBAH) --}}
            <div class="lg:hidden">
                {{-- Tombol hamburger kustom untuk animasi --}}
                <button id="menu-btn" class="focus:outline-none space-y-2">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>

        </nav>
    </header>

    {{--
    MENU MOBILE DIPINDAHKAN KELUAR DARI HEADER
    Ini adalah menu Off-Canvas (Slide-in)
    --}}

    <div id="menu-backdrop"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 ease-in-out opacity-0">
    </div>

    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-[#0a1a3c] z-50 
               transform translate-x-full transition-transform duration-300 ease-in-out 
               shadow-lg overflow-y-auto">

        {{-- Konten Menu --}}
        <div class="p-6">

            <a href="#" class="mobile-link">Home</a>

            {{-- Dropdown About --}}
            <button class="mobile-dropdown-toggle" onclick="toggleDropdown('about')">
                <span>About</span>
                <i class="fa-solid fa-chevron-down chev-mobile"></i>
            </button>
            <div id="dropdown-about" class="mobile-dropdown">
                <a href="#">Our Story</a>
                <a href="#">Our Team</a>
            </div>

            {{-- Dropdown Menu --}}
            <button class="mobile-dropdown-toggle" onclick="toggleDropdown('menu')">
                <span>Menu</span>
                <i class="fa-solid fa-chevron-down chev-mobile"></i>
            </button>
            <div id="dropdown-menu" class="mobile-dropdown">
                <a href="#">Food</a>
                <a href="#">Drinks</a>
                <a href="#">Snacks</a>
            </div>

            {{-- Dropdown Gallery --}}
            <button class="mobile-dropdown-toggle" onclick="toggleDropdown('gallery')">
                <span>Gallery</span>
                <i class="fa-solid fa-chevron-down chev-mobile"></i>
            </button>
            <div id="dropdown-gallery" class="mobile-dropdown">
                <a href="#">Photos</a>
                <a href="#">Videos</a>
            </div>

            {{-- Tombol Aksi (CTA) di bagian bawah --}}
            <div class="mt-8 border-t border-gray-700 pt-6 space-y-4">
                <a href="#" class="block w-full text-center py-3 px-4 rounded-full font-medium 
                   bg-white text-[#0a1a3c] transform transition-transform hover:scale-105">
                    Pemesanan
                </a>
                <a href="#" class="block w-full text-center py-3 px-4 rounded-full font-light 
                   bg-transparent text-white border border-white 
                   transform transition-all hover:scale-105 hover:bg-white hover:text-[#0a1a3c]">
                    Contact Us
                </a>
            </div>
        </div>
    </div>


    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuBackdrop = document.getElementById('menu-backdrop');

        // Toggle menu utama
        menuBtn.addEventListener('click', () => {
            // 1. Animasi tombol
            menuBtn.classList.toggle('open');

            // 2. Tampilkan/sembunyikan backdrop
            menuBackdrop.classList.toggle('hidden');
            // Kita perlu delay sedikit agar transisi opacity berfungsi
            setTimeout(() => {
                menuBackdrop.classList.toggle('opacity-0');
            }, 10);

            // 3. Animasi slide-in/out menu
            mobileMenu.classList.toggle('translate-x-full');

            // 4. Kunci scroll body saat menu terbuka
            document.body.classList.toggle('overflow-hidden');
        });

        // Klik backdrop untuk menutup menu
        menuBackdrop.addEventListener('click', () => {
            // Cukup simulasikan klik tombol menu untuk menutup semuanya
            menuBtn.click();
        });

        // Fungsi dropdown accordion yang baru
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            const button = dropdown.previousElementSibling; // Ini adalah tombolnya

            // Toggle class 'open' pada tombol (untuk rotasi chevron)
            button.classList.toggle('open');

            // Toggle class 'open' pada dropdown (untuk animasi max-height)
            dropdown.classList.toggle('open');
        }
    </script>

    <main>
        @yield('content')
    </main>
</body>

</html>