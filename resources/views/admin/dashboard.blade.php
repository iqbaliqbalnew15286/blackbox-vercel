@extends('layouts.admin-app')
@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>Dashboard Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
        <style>
            /* Definisi Warna Kafe */
            :root {
                --cafe-dark-blue: #091936;
                --cafe-accent-brown: #58320D;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f2f5;
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            /* Mengganti warna aksen hijau dengan cokelat kopi */
            .text-cafe-accent {
                color: var(--cafe-accent-brown);
            }
        </style>
    </head>

    <body class="bg-[#f0f2f5] text-[#292929] font-sans p-6 md:p-10">
        <div class="max-w-7xl mx-auto">
            <header class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-xl font-bold">
                        Selamat Datang,
                      
                    </h1>
                    <p class="text-sm font-normal text-gray-600">
                        Kelola menu dan pesanan kafe Anda <span class="text-cafe-accent">di sini</span>.
                    </p>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                    <span id="current-date"></span>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </header>

            <div class="mb-8">
                <div class="w-full rounded-xl overflow-hidden shadow-lg p-6 bg-[#091936]">

                    <h2 class="text-xl text-white font-bold mb-4 border-b border-white/30 pb-3">Statistik Kunci Hari Ini
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-white">

                        {{-- WIDGET 1: Pesanan Baru --}}
                        <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm">
                            <p class="text-3xl font-extrabold mb-1">12</p>
                            <p class="text-xs opacity-80 uppercase tracking-wider">Pesanan Baru</p>
                        </div>

                        {{-- WIDGET 2: Total Penjualan --}}
                        <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm">
                            <p class="text-3xl font-extrabold mb-1">Rp 485K</p>
                            <p class="text-xs opacity-80 uppercase tracking-wider">Penjualan Hari Ini</p>
                        </div>

                        {{-- WIDGET 3: Reservasi Aktif --}}
                        <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm">
                            <p class="text-3xl font-extrabold mb-1">3</p>
                            <p class="text-xs opacity-80 uppercase tracking-wider">Reservasi Aktif</p>
                        </div>

                        {{-- WIDGET 4: Item Terlaris (Contoh) --}}
                        <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm">
                            <p class="text-base font-bold mb-1 line-clamp-1">Espresso Blend A</p>
                            <p class="text-xs opacity-80 uppercase tracking-wider mt-2">Item Terlaris</p>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    {{-- Card 1: Menu & Produk --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-mug-hot fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Manajemen Menu</h2>
                        <p class="text-sm text-gray-600 leading-tight">Tambahkan, sunting, dan hapus semua item makanan,
                            minuman, dan *snack*.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Menu</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 2: Pesanan (Orders) --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-receipt fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Daftar Pesanan</h2>
                        <p class="text-sm text-gray-600 leading-tight">Lihat dan proses semua pesanan yang masuk secara
                            *real-time*.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Pesanan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 3: Stok/Inventory --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-warehouse fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Stok & Inventaris</h2>
                        <p class="text-sm text-gray-600 leading-tight">Pantau dan kelola stok bahan baku agar tidak
                            kehabisan kopi, gula, dll.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Stok</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 4: Event & Promosi --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-tags fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Promosi & Event</h2>
                        <p class="text-sm text-gray-600 leading-tight">Atur info *event* spesial, diskon musiman, dan
                            promosi kafe.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Atur Promosi</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 5: Staff & Karyawan --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-user-friends fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Data Karyawan</h2>
                        <p class="text-sm text-gray-600 leading-tight">Kelola daftar dan detail staf yang bekerja di kafe.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 6: Media & Galeri --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-images fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Media Galeri</h2>
                        <p class="text-sm text-gray-600 leading-tight">Kelola foto-foto suasana, produk, dan desain kafe.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Gambar</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 7: Ulasan & Feedback --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Ulasan Pelanggan</h2>
                        <p class="text-sm text-gray-600 leading-tight">Lihat dan tanggapi *feedback* serta ulasan dari
                            pelanggan.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Ulasan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 8: Laporan Penjualan --}}
                    <a href="#"
                        class="bg-white rounded-lg p-4 flex flex-col space-y-3 shadow-md border border-[#D9D9D9] transition-transform duration-300 hover:scale-[1.02]">
                        <div class="text-cafe-accent">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                        <h2 class="font-semibold text-base">Laporan Penjualan</h2>
                        <p class="text-sm text-gray-600 leading-tight">Akses data dan laporan penjualan harian, mingguan,
                            dan bulanan.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Akses Laporan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
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
                // Update date every minute to keep it current
                setInterval(updateDate, 60000);
            });
        </script>
    </body>

    </html>
@endsection