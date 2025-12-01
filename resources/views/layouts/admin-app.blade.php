<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title', 'Admin Panel')</title>
    {{-- Menggunakan versi 6.5.2 untuk ikon yang lebih baru --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Sembunyikan scrollbar untuk semua elemen kecuali untuk sidebar di Chrome/Safari */
        ::-webkit-scrollbar {
            width: 0.5em;
            display: none;
        }

        /* Logic untuk menentukan tema admin dari URL */
        @php
            $isCaffeAdmin = request()->is('admin/caffe*') || !request()->is('admin/*');
            $isSalonAdmin = request()->is('admin/salon*');

            // Menentukan Warna & Teks Berdasarkan Mode Aktif
            if ($isSalonAdmin) {
                $adminTitle = 'BEAUTY SALON';
                $bgColor = '#db2780'; // Pink
                $accentColor = '#ffffff';
                $linkActiveText = '#db2780';
            } else {
                $adminTitle = 'WARUNG KOPI';
                $bgColor = '#000000'; // Black
                $accentColor = '#ffffff';
                $linkActiveText = '#000000';
            }
        @endphp

        :root {
            /* Variabel CSS global yang diatur oleh PHP di atas */
            --admin-bg-color: {{ $bgColor }};
            --admin-accent-color: {{ $accentColor }};
            --admin-link-active-text: {{ $linkActiveText }};
            --admin-sidebar-text-color: {{ $accentColor }};
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            background-color: var(--admin-bg-color);
            color: var(--admin-sidebar-text-color);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-link-active {
            background-color: #ffffff;
            color: var(--admin-link-active-text);
            font-weight: 600;
        }

        /* Memperbaiki warna submenu saat tidak aktif */
        .collapsible-content a {
            color: var(--admin-sidebar-text-color);
        }

        .collapsible-content a:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .collapsible-content a.sidebar-link-active {
            color: var(--admin-link-active-text);
            background-color: #ffffff;
        }

        .collapsible-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .collapsible-content.expanded {
            max-height: 400px;
            transition: max-height 0.4s ease-in;
        }

        .rotate-90 {
            transform: rotate(90deg);
        }

        /* Sembunyikan scrollbar untuk sidebar di Firefox dan IE */
        .sidebar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Responsiveness */
        @media (max-width: 767px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="flex bg-gray-100 min-h-screen">
    {{-- Sidebar --}}
    <aside id="sidebar"
        class="sidebar fixed top-0 left-0 bottom-0 w-64 flex flex-col justify-between p-6 z-50 md:translate-x-0 -translate-x-full">
        <div class="flex flex-col h-full">

            {{-- LOGO & TITLE --}}
            <div class="mb-6 flex flex-col items-start space-y-2">
                {{-- LOGO --}}
                <div class="flex items-center space-x-3 w-full">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="Logo {{ $adminTitle }}"
                        class="w-12 h-12 rounded-full bg-white object-contain">
                    <div class="text-white">
                        <div class="font-bold text-sm">{{ $adminTitle }}</div>
                        <div class="italic text-[11px] opacity-80">Admin Panel</div>
                    </div>
                </div>

                {{-- Admin Switcher/Pindah Halaman --}}
                <div class="w-full flex justify-between gap-2 mt-3 text-white/80 text-xs font-semibold pt-2 border-t border-white/20">
                    {{-- Link ke Admin Caffe --}}
                    <a href="{{ route('admin.caffe.dashboard') }}"
                        class="px-3 py-1 rounded-full border transition-all duration-300 flex-1 text-center
                        @if ($isCaffeAdmin) bg-white text-black font-bold border-white @else border-white/50 hover:bg-white/10 @endif">
                        <i class="fa-solid fa-mug-hot mr-1"></i> Mode Caffe
                    </a>
                    {{-- Link ke Admin Salon --}}
                    <a href="{{ route('admin.salon.dashboard') }}"
                        class="px-3 py-1 rounded-full border transition-all duration-300 flex-1 text-center
                        @if ($isSalonAdmin) bg-white text-black font-bold border-white @else border-white/50 hover:bg-white/10 @endif">
                        <i class="fa-solid fa-spa mr-1"></i> Mode Salon
                    </a>
                </div>
            </div>

            {{-- NAVIGATION --}}
            <nav class="space-y-1 text-sm flex-1 overflow-y-auto pr-1">

                {{-- Dashboard Link --}}
                <a href="{{ $isSalonAdmin ? route('admin.salon.dashboard') : route('admin.caffe.dashboard') }}"
                    class="sidebar-link @if (request()->routeIs(['admin.caffe.dashboard', 'admin.salon.dashboard'])) sidebar-link-active @endif">
                    <i class="fa-solid fa-gauge w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                {{-- ---------------------------------------------------- --}}
                {{-- KELOMPOK MENU: CAFFE ADMIN (Hanya tampil di mode Caffe) --}}
                {{-- ---------------------------------------------------- --}}
                @if ($isCaffeAdmin && !$isSalonAdmin)
                    <h3 class="text-white/50 text-xs font-semibold uppercase pt-4 pb-1">Manajemen Caffe</h3>

                    {{-- Editor (Gallery & Testimonial) --}}
                    @php
                        $editActive = request()->routeIs(['admin.caffe.gallery.*', 'admin.caffe.testimonial.*']);
                    @endphp
                    <div>
                        <button id="editor-toggle" class="sidebar-link w-full text-left">
                            <i class="fa-solid fa-pencil w-5 text-center"></i>
                            <span class="flex-1">Editor</span>
                            <i id="editor-arrow"
                                class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $editActive ? 'rotate-90' : '' }}"></i>
                        </button>

                        <div id="editor-submenu"
                            class="pl-10 mt-1 space-y-1 collapsible-content {{ $editActive ? 'expanded' : '' }}">
                            <a href="{{ route('admin.caffe.gallery.index') }}"
                                class="block p-2 text-xs rounded-md transition @if (request()->routeIs('admin.caffe.gallery.*')) sidebar-link-active @endif">
                                Gallery
                            </a>
                            <a href="{{ route('admin.caffe.testimonial.index') }}"
                                class="block p-2 text-xs rounded-md transition @if (request()->routeIs('admin.caffe.testimonial.*')) sidebar-link-active @endif">
                                Testimonial
                            </a>
                        </div>
                    </div>


                    {{-- Manajemen Menu --}}
                    @php
                        $menuActive = request()->routeIs(['admin.caffe.menu.*', 'admin.caffe.promo.*']);
                    @endphp
                    <div>
                        <button id="menu-toggle" class="sidebar-link w-full text-left">
                            <i class="fa-solid fa-mug-hot w-5 text-center"></i>
                            <span class="flex-1">Manajemen Menu</span>
                            <i id="menu-arrow"
                                class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $menuActive ? 'rotate-90' : '' }}"></i>
                        </button>
                        <div id="menu-submenu"
                            class="pl-10 mt-1 space-y-1 collapsible-content {{ $menuActive ? 'expanded' : '' }}">
                            <a href="{{ route('admin.caffe.menu.index') }}"
                                class="block p-2 text-xs rounded-md transition @if (request()->routeIs('admin.caffe.menu.*')) sidebar-link-active @endif">
                                Daftar Menu
                            </a>
                        </div>
                    </div>

                    {{-- Manajemen About --}}
                    @php
                        $aboutActive = request()->routeIs(['admin.caffe.ourteam.*']);
                    @endphp
                    <div>
                        <button id="about-toggle" class="sidebar-link w-full text-left">
                            <i class="fa-solid fa-info-circle w-5 text-center"></i>
                            <span class="flex-1">Manajemen About</span>
                            <i id="about-arrow"
                                class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $aboutActive ? 'rotate-90' : '' }}"></i>
                        </button>
                        <div id="about-submenu"
                            class="pl-10 mt-1 space-y-1 collapsible-content {{ $aboutActive ? 'expanded' : '' }}">
                            <a href="{{ route('admin.caffe.ourteam.index') }}"
                                class="block p-2 text-xs rounded-md transition @if (request()->routeIs('admin.caffe.ourteam.*')) sidebar-link-active @endif">
                                Our Team
                            </a>
                        </div>
                    </div>
                @endif


                {{-- ---------------------------------------------------- --}}
                {{-- KELOMPOK MENU: SALON ADMIN (Hanya tampil di mode Salon) --}}
                {{-- ---------------------------------------------------- --}}
                @if ($isSalonAdmin)
                    <h3 class="text-white/50 text-xs font-semibold uppercase pt-4 pb-1">Manajemen Salon</h3>

                    {{-- Manajemen Salon (Layanan, Testimonial & Gallery) --}}
                    @php
                        $salonActive = request()->routeIs(['admin.salon.layanansalon.*', 'admin.salon.testimonialsalon.*', 'admin.salon.gallery.*']);
                    @endphp
                    <div>
                        <button id="salon-toggle" class="sidebar-link w-full text-left">
                            <i class="fa-solid fa-spa w-5 text-center"></i>
                            <span class="flex-1">Manajemen Salon</span>
                            <i id="salon-arrow"
                                class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $salonActive ? 'rotate-90' : '' }}"></i>
                        </button>
                        <div id="salon-submenu"
                            class="pl-10 mt-1 space-y-1 collapsible-content {{ $salonActive ? 'expanded' : '' }}">
                            <a href="{{ route('admin.salon.layanansalon.index') }}"
                                class="block p-2 text-xs rounded-md transition
                                @if (request()->routeIs('admin.salon.layanansalon.*')) sidebar-link-active @endif">
                                Layanan Salon
                            </a>
                            <a href="{{ route('admin.salon.testimonialsalon.index') }}"
                                class="block p-2 text-xs rounded-md transition
                                @if (request()->routeIs('admin.salon.testimonialsalon.*')) sidebar-link-active @endif">
                                Testimoni Salon
                            </a>
                            <a href="{{ route('admin.salon.gallery.index') }}"
                                class="block p-2 text-xs rounded-md transition
                                @if (request()->routeIs('admin.salon.gallery.*')) sidebar-link-active @endif">
                                Galeri Salon
                            </a>
                        </div>
                    </div>

                    {{-- Menu lain di Salon dapat ditambahkan di sini --}}
                @endif
                {{-- END OF MODE SPECIFIC MENUS --}}

            </nav>

            {{-- Logout & Go to Web --}}
            <div class="pt-4 space-y-2">
                {{-- Logout Button --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-white text-sm font-semibold rounded-lg px-4 py-2 flex items-center justify-center gap-2 transition"
                        style="background-color: {{ $isSalonAdmin ? '#c5166c' : '#dc2626' }}; hover:background-color: {{ $isSalonAdmin ? '#a8135a' : '#b91c1c' }};">
                        <span>Log Out</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>

                {{-- Go to Web Button --}}
                <a href="{{ url('/') }}"
                    class="w-full bg-gray-700 text-white text-sm font-semibold rounded-lg px-4 py-2 flex items-center justify-center gap-2 hover:bg-gray-600 transition">
                    <span>Go to Web</span>
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </aside>

    {{-- Backdrop untuk mobile --}}
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

    {{-- Main Content --}}
    <main class="flex-1 md:ml-64 flex flex-col min-h-screen overflow-hidden bg-gray-100">
        {{-- Header Konten Utama (dengan toggle button) --}}
        <header class="bg-white shadow-md p-4 sticky top-0 z-30 flex items-center justify-between md:hidden">
            <h1 class="text-lg font-semibold text-gray-900">@yield('title', $adminTitle . ' Panel')</h1>
            <button id="toggleSidebar" class="p-2 text-gray-700 hover:text-gray-900">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                {{-- Konten Utama Akan di-render di sini --}}
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleSidebar = document.getElementById("toggleSidebar");
        const backdrop = document.getElementById("sidebar-backdrop");

        // Logic untuk menampilkan/menyembunyikan sidebar di mobile
        if (toggleSidebar && backdrop) {
            toggleSidebar.addEventListener("click", () => {
                sidebar.classList.toggle("show");
                backdrop.classList.toggle("hidden");
            });

            backdrop.addEventListener("click", () => {
                sidebar.classList.remove("show");
                backdrop.classList.add("hidden");
            });
        }

        // Logic untuk toggle submenu (Collapsible)
        // Pastikan semua ID yang digunakan di sini ada di HTML (termasuk menu-menu Caffe/Salon)
        const toggles = [
            // Caffe Menu
            { btn: "editor-toggle", content: "editor-submenu", arrow: "editor-arrow" },
            { btn: "menu-toggle", content: "menu-submenu", arrow: "menu-arrow" },
            { btn: "about-toggle", content: "about-submenu", arrow: "about-arrow" },
            // Salon Menu
            { btn: "salon-toggle", content: "salon-submenu", arrow: "salon-arrow" },
            // Tambahkan toggle lain jika ada
            { btn: "transaksi-toggle", content: "transaksi-submenu", arrow: "transaksi-arrow" },
            { btn: "kasir-toggle", content: "kasir-submenu", arrow: "kasir-arrow" },
        ];

        toggles.forEach(({ btn, content, arrow }) => {
            const button = document.getElementById(btn);
            const submenu = document.getElementById(content);
            const chevron = document.getElementById(arrow);

            if (button && submenu && chevron) {
                // Periksa apakah submenu harus terbuka secara default saat halaman dimuat
                if (submenu.classList.contains("expanded")) {
                    submenu.style.maxHeight = submenu.scrollHeight + "px";
                }

                button.addEventListener("click", () => {
                    // Tutup semua submenu lain kecuali yang sedang diklik
                    toggles.forEach(otherToggle => {
                        if (otherToggle.btn !== btn) {
                            const otherSubmenu = document.getElementById(otherToggle.content);
                            const otherChevron = document.getElementById(otherToggle.arrow);
                            if (otherSubmenu && otherChevron) {
                                otherSubmenu.classList.remove("expanded");
                                otherChevron.classList.remove("rotate-90");
                                otherSubmenu.style.maxHeight = '0'; // Atur tinggi ke 0
                            }
                        }
                    });

                    // Toggle submenu yang diklik
                    if (submenu.classList.contains("expanded")) {
                        submenu.classList.remove("expanded");
                        chevron.classList.remove("rotate-90");
                        submenu.style.maxHeight = '0';
                    } else {
                        submenu.classList.add("expanded");
                        chevron.classList.add("rotate-90");
                        // Set maxHeight ke scrollHeight untuk transisi yang mulus
                        submenu.style.maxHeight = submenu.scrollHeight + "px";
                    }
                });
            }
        });
    </script>
</body>

</html>
