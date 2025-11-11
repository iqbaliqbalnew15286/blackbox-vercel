<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title', 'Admin Panel Kopi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Menggunakan versi 6.5.2 untuk ikon yang lebih baru --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <style>
        :-webkit-scrollbar {
            width: 0.5em;
            display: none;
        }

        :root {
            --cafe-dark-blue: #0b1c3f;
            --cafe-accent-brown: #704010;
            --cafe-light-gray: #d9d9d9;
            --cafe-link-active-text: #0b1c3f;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            background-color: var(--cafe-dark-blue);
            color: white;
            transition: transform 0.3s ease-in-out;
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
            color: var(--cafe-dark-blue);
            font-weight: 600;
            border-radius: 0.5rem;
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

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>

<!-- 🔧 Perbaikan di sini: ubah bg-gray-900 jadi bg-gray-100 agar kembali putih -->

<body class="flex bg-gray-100 min-h-screen text-gray-900">

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="sidebar fixed top-0 left-0 bottom-0 w-64 flex flex-col justify-between p-6 z-50 md:translate-x-0 -translate-x-full md:show">
        <div class="flex flex-col h-full">

            {{-- LOGO --}}
            <div class="mb-8 flex items-center space-x-3">
                <img src="{{ asset('assets/warghe.png') }}" alt="Logo Warung Kopi"
                    class="w-12 h-12 rounded-full bg-white object-contain">
                <div class="text-white">
                    <div class="font-bold text-sm">WARUNG KOPI</div>
                    <div class="italic text-[11px] opacity-80">Admin Panel</div>
                </div>
            </div>

            {{-- NAVIGATION --}}
            <nav class="space-y-1 text-sm flex-1 overflow-y-auto pr-1">

                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link @if (request()->routeIs('admin.dashboard')) sidebar-link-active @endif">
                    <i class="fa-solid fa-gauge w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Editor --}}
                @php
                    $editActive = request()->routeIs(['admin.image.*', 'admin.writings.*', 'admin.testimonial.*']);
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
                        <a href="{{ route('admin.image.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.image.*')) sidebar-link-active @endif">
                            Image
                        </a>
                        <a href="{{ route('admin.writings.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.writings.*')) sidebar-link-active @endif">
                            Writings
                        </a>
                        <a href="{{ route('admin.testimonial.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.testimonial.*')) sidebar-link-active @endif">
                            Testimonial
                        </a>
                    </div>
                </div>

                {{-- Manajemen Menu --}}
                @php
                    $menuActive = request()->routeIs(['admin.menu.*', 'admin.promo.*', 'admin.gallery.*']);
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
                        <a href="{{ route('admin.menu.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.menu.*')) sidebar-link-active @endif">
                            Daftar Menu
                        </a>
                        <a href="{{ route('admin.promo.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.promo.*')) sidebar-link-active @endif">
                            Spesial & Promo
                        </a>
                        <a href="{{ route('admin.gallery.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.gallery.*')) sidebar-link-active @endif">
                            Galeri Media
                        </a>
                    </div>
                </div>

                {{-- Manajemen Transaksi --}}
                @php
                    $transaksiActive = request()->routeIs(['admin.orders.*', 'admin.reports.*']);
                @endphp
                <div>
                    <button id="transaksi-toggle" class="sidebar-link w-full text-left">
                        <i class="fa-solid fa-receipt w-5 text-center"></i>
                        <span class="flex-1">Manajemen Transaksi</span>
                        <i id="transaksi-arrow"
                            class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $transaksiActive ? 'rotate-90' : '' }}"></i>
                    </button>
                    <div id="transaksi-submenu"
                        class="pl-10 mt-1 space-y-1 collapsible-content {{ $transaksiActive ? 'expanded' : '' }}">
                        <a href="#" class="block p-2 text-xs rounded-md hover:bg-gray-700 transition">Pesanan</a>
                        <a href="#" class="block p-2 text-xs rounded-md hover:bg-gray-700 transition">Laporan
                            Penjualan</a>
                    </div>
                </div>

                {{-- Manajemen Kasir --}}
                @php
                    $kasirActive = request()->routeIs(['admin.kasir.*', 'admin.reports.*']);
                @endphp
                <div>
                    <button id="kasir-toggle" class="sidebar-link w-full text-left">
                        <i class="fa-solid fa-cash-register w-5 text-center"></i>
                        <span class="flex-1">Manajemen Kasir</span>
                        <i id="kasir-arrow"
                            class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $kasirActive ? 'rotate-90' : '' }}"></i>
                    </button>
                    <div id="kasir-submenu"
                        class="pl-10 mt-1 space-y-1 collapsible-content {{ $kasirActive ? 'expanded' : '' }}">
                        <a href="{{ route('admin.kasir.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.kasir.*')) sidebar-link-active @endif">
                            Kasir
                        </a>
                        <a href="{{ route('admin.reports.index') }}"
                            class="block p-2 text-xs rounded-md hover:bg-gray-700 transition @if (request()->routeIs('admin.reports.*')) sidebar-link-active @endif">
                            Laporan Penjualan
                        </a>
                    </div>
                </div>

                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span>Users Management</span>
                </a>

                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i>
                    <span>Curator.io</span>
                </a>

                <a href="#" class="sidebar-link">
                    <i class="fas fa-comments w-5 text-center"></i>
                    <span>Feedback</span>
                </a>

                <a href="#" class="sidebar-link">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span>Settings</span>
                </a>
            </nav>

            <div class="pt-4 space-y-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[var(--cafe-accent-brown)] text-white text-sm font-semibold rounded-lg px-4 py-2 flex items-center justify-center gap-2 hover:bg-[#58320D] transition">
                        <span>Log Out</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>

                <a href="{{ url('/') }}"
                    class="w-full bg-[var(--cafe-accent-brown)] text-white text-sm font-semibold rounded-lg px-4 py-2 flex items-center justify-center gap-2 hover:bg-[#58320D] transition">
                    <span>Go to Web</span>
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </aside>

    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

    <main class="flex-1 md:ml-64 flex flex-col min-h-screen overflow-hidden bg-gray-100">
        <div class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleSidebar = document.getElementById("toggleSidebar");
        const backdrop = document.getElementById("sidebar-backdrop");

        if (toggleSidebar) {
            toggleSidebar.addEventListener("click", () => {
                sidebar.classList.toggle("show");
                backdrop.classList.toggle("hidden");
            });
        }

        if (backdrop) {
            backdrop.addEventListener("click", () => {
                sidebar.classList.remove("show");
                backdrop.classList.add("hidden");
            });
        }

        const toggles = [{
                btn: "editor-toggle",
                content: "editor-submenu",
                arrow: "editor-arrow"
            },
            {
                btn: "menu-toggle",
                content: "menu-submenu",
                arrow: "menu-arrow"
            },
            {
                btn: "transaksi-toggle",
                content: "transaksi-submenu",
                arrow: "transaksi-arrow"
            },
            {
                btn: "kasir-toggle",
                content: "kasir-submenu",
                arrow: "kasir-arrow"
            },
        ];

        toggles.forEach(({
            btn,
            content,
            arrow
        }) => {
            const button = document.getElementById(btn);
            const submenu = document.getElementById(content);
            const chevron = document.getElementById(arrow);

            if (button && submenu && chevron) {
                button.addEventListener("click", () => {
                    submenu.classList.toggle("expanded");
                    chevron.classList.toggle("rotate-90");
                });
            }
        });
    </script>
</body>

</html>
