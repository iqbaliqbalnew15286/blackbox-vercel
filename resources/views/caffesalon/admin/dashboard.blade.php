@extends('layouts.admin-app')
@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>Dashboard Admin Salon</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
        <style>
            /* Definisi Warna Salon (Pink Neon & Hitam) */
            :root {
                --salon-dark-bg: #0d1117;
                /* Background Sangat Gelap */
                --salon-card-bg: #1a1a1a;
                /* Hitam untuk Card */
                --salon-accent-pink: #ec4899;
                /* Pink Neon */
                --salon-text-light: #f3f4f6;
                /* Teks Utama */
                --salon-text-muted: #a0aec0;
                /* Teks Sekunder */
            }

            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #0d1117, #000000); /* Gradasi gelap ke hitam */
                color: var(--salon-text-light);
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .text-salon-accent {
                color: var(--salon-accent-pink);
            }

            .card-style {
                background-color: var(--salon-card-bg);
                border: 1px solid rgba(236, 72, 153, 0.2); /* Border pink transparan */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6), 0 0 8px rgba(236, 72, 153, 0.3); /* Shadow gelap + glow pink */
            }

            .card-style:hover {
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.8), 0 0 15px rgba(236, 72, 153, 0.6); /* Hover glow pink lebih intens */
                transform: scale(1.02);
            }

            /* Badge notifikasi */
            .badge-red {
                background-color: #ef4444; /* Red 500 */
                color: white;
                font-weight: bold;
                padding: 0.25rem 0.625rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                box-shadow: 0 2px 5px rgba(239, 68, 68, 0.4);
            }
        </style>
    </head>

    <body class="p-6">
        <div class="max-w-7xl mx-auto">
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Selamat Datang,
                        <span class="text-salon-accent">
                            {{ Auth::user()->name }}
                        </span>
                    </h1>
                    <p class="text-sm font-normal text-gray-400">
                        Kelola layanan dan jadwal <span class="text-salon-accent">Elegance Salon</span> Anda di sini.
                    </p>
                </div>
                <div class="flex items-center space-x-2 text-gray-400 text-sm flex-shrink-0">
                    <span id="current-date"></span>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </header>

            <div class="mb-8">
                <div class="w-full rounded-xl overflow-hidden shadow-xl">
                    {{-- Banner Salon --}}
                    <div class="w-full h-40 flex items-center justify-center p-6"
                        style="background: linear-gradient(to right, #1a1a1a, #ec4899);">
                        
                        <div class="text-center">
                            <i class="fas fa-spa text-white text-5xl mb-2" style="text-shadow: 0 0 10px rgba(255,255,255,0.7);"></i>
                            <h2 class="text-3xl font-extrabold text-white tracking-widest">ELEGANCE SALON</h2>
                            <p class="text-sm text-gray-200 font-medium">Beauty. Style. Perfection.</p>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                {{-- Grid 4x2 --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Card 1: Manajemen Layanan (Menu & Produk) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-cut"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Manajemen Layanan</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Saat ini ada <strong class="text-salon-accent">{{ $menuItemCount ?? 0 }}</strong> layanan
                            tersedia.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Layanan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 2: Janji Temu (Orders) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-calendar-check"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <div class="flex items-center justify-between">
                            <h2 class="font-semibold text-base text-white">Janji Temu</h2>
                            @if (isset($newOrdersCount) && $newOrdersCount > 0)
                                <span class="badge-red">{{ $newOrdersCount }}</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-400 leading-tight">Kelola janji temu yang masuk secara *real-time*.</p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Janji Temu</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 3: Produk Jual (Stok/Inventory) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-boxes"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Stok Produk</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Ada <strong class="text-red-400">{{ $lowStockItemsCount ?? 0 }}</strong> produk yang stoknya
                            menipis.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Stok</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 4: Penawaran Spesial (Event & Promosi) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-gift"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Penawaran Spesial</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Saat ini ada <strong class="text-salon-accent">{{ $activePromosCount ?? 0 }}</strong> penawaran
                            aktif.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Atur Penawaran</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 5: Terapis & Stylist (Staff & Karyawan) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-user-tie"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Data Terapis</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Total <strong class="text-salon-accent">{{ $staffCount ?? 0 }}</strong> terapis/stylist terdaftar.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 6: Portofolio (Media & Galeri) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-camera-retro"></i> {{-- Icon lebih relevan untuk salon --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Portofolio & Galeri</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Terdapat <strong class="text-salon-accent">{{ $galleryImageCount ?? 0 }}</strong> gambar di
                            galeri portofolio.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Gambar</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 7: Ulasan Pelanggan --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-star-half-alt"></i> {{-- Icon lebih relevan --}}
                        </div>
                        <div class="flex items-center justify-between">
                            <h2 class="font-semibold text-base text-white">Ulasan Pelanggan</h2>
                            @if (isset($pendingReviewsCount) && $pendingReviewsCount > 0)
                                <span class="badge-red">{{ $pendingReviewsCount }}</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-400 leading-tight">Tanggapi *feedback* serta ulasan baru dari pelanggan.
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Ulasan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 8: Laporan Pendapatan (Laporan Penjualan) --}}
                    <a href="#"
                        class="card-style rounded-lg p-5 flex flex-col space-y-3 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-salon-accent text-3xl">
                            <i class="fas fa-chart-pie"></i> {{-- Icon lebih relevan --}}
                        </div>
                        <h2 class="font-semibold text-base text-white">Laporan Pendapatan</h2>
                        <p class="text-sm text-gray-400 leading-tight">
                            Pendapatan hari ini: <strong class="text-green-500">{{ $todaySalesTotal ?? 'Rp 0' }}</strong>
                        </p>
                        <span class="text-xs text-salon-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Akses Laporan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dateSpan = document.getElementById('current-date');

                function updateDate() {
                    const now = new Date();
                    const options = {
                        timeZone: 'Asia/Jakarta',
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = new Intl.DateTimeFormat('id-ID', options).format(now);
                    dateSpan.textContent = formattedDate;
                }

                updateDate();
                setInterval(updateDate, 60000);
            });
        </script>
    </body>

    </html>
@endsection