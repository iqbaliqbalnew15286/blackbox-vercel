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

            .text-cafe-accent {
                color: var(--cafe-accent-brown);
            }
        </style>
    </head>

    {{-- MODIFIKASI: Menambahkan padding p-6 yang konsisten --}}
    <body class="bg-[#f0f2f5] text-[#292929] font-sans p-6">
        <div class="max-w-7xl mx-auto">
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Selamat Datang,
                        <span class="text-cafe-accent">
                            {{ Auth::user()->name }}
                        </span>
                    </h1>
                    <p class="text-sm font-normal text-gray-600">
                        Kelola menu dan pesanan kafe Anda <span class="text-cafe-accent">di sini</span>.
                    </p>
                </div>
                <div class="flex items-center space-x-2 text-gray-600 text-sm flex-shrink-0">
                    <span id="current-date"></span>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </header>

            <div class="mb-8">
                <div class="w-full rounded-xl overflow-hidden border border-gray-200">
                    {{-- Placeholder Banner Kafe --}}
                    <img alt="Interior Kafe Modern"
                        class="w-full h-40 object-cover" src="{{ asset('assets/view.jpg') }}"
                        style="background: linear-gradient(to right, #091936, #58320D); height: 10rem; object-fit: cover;"
                        onerror="this.style.background='linear-gradient(to right, #091936, #58320D)'; this.src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';" />
                </div>
            </div>

            <main>
                {{-- MODIFIKASI: Layout grid diubah menjadi lg:grid-cols-4 agar rapi (8 card) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Card 1: Menu & Produk --}}
                    {{-- MODIFIKASI: Padding diubah ke p-5 dan min-h-[170px] ditambah --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-mug-hot"></i>
                        </div>
                        <h2 class="font-semibold text-base">Manajemen Menu</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Saat ini ada <strong class="text-cafe-accent">{{ $menuItemCount ?? 0 }}</strong> item di menu Anda.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Menu</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 2: Pesanan (Orders) --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-receipt"></i>
                        </div>
                        {{-- MODIFIKASI: Menambahkan badge notifikasi --}}
                        <div class="flex items-center justify-between">
                            <h2 class="font-semibold text-base">Daftar Pesanan</h2>
                            @if(isset($newOrdersCount) && $newOrdersCount > 0)
                                <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $newOrdersCount }}</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 leading-tight">Proses pesanan yang masuk secara *real-time*.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Pesanan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 3: Stok/Inventory --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <h2 class="font-semibold text-base">Stok & Inventaris</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Ada <strong class="text-red-600">{{ $lowStockItemsCount ?? 0 }}</strong> item yang stoknya menipis.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Stok</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 4: Event & Promosi --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h2 class="font-semibold text-base">Promosi & Event</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Saat ini ada <strong class="text-cafe-accent">{{ $activePromosCount ?? 0 }}</strong> promo & event aktif.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Atur Promosi</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 5: Staff & Karyawan --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h2 class="font-semibold text-base">Data Karyawan</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Total <strong class="text-cafe-accent">{{ $staffCount ?? 0 }}</strong> karyawan terdaftar di sistem.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 6: Media & Galeri --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-images"></i>
                        </div>
                        <h2 class="font-semibold text-base">Media Galeri</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Terdapat <strong class="text-cafe-accent">{{ $galleryImageCount ?? 0 }}</strong> gambar di galeri media.
                        </p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Gambar</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 7: Ulasan & Feedback --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-star"></i>
                        </div>
                        {{-- MODIFIKASI: Menambahkan badge notifikasi --}}
                        <div class="flex items-center justify-between">
                            <h2 class="font-semibold text-base">Ulasan Pelanggan</h2>
                            @if(isset($pendingReviewsCount) && $pendingReviewsCount > 0)
                                <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $pendingReviewsCount }}</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 leading-tight">Tanggapi *feedback* serta ulasan baru dari pelanggan.</p>
                        <span class="text-xs text-cafe-accent font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Lihat Ulasan</span>
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>

                    {{-- Card 8: Laporan Penjualan --}}
                    <a href="#"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-md border border-gray-200 transition-transform duration-300 hover:scale-[1.02] min-h-[170px]">
                        <div class="text-cafe-accent text-3xl">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h2 class="font-semibold text-base">Laporan Penjualan</h2>
                        {{-- MODIFIKASI: Deskripsi statis diganti data dinamis --}}
                        <p class="text-sm text-gray-600 leading-tight">
                            Penjualan hari ini: <strong class="text-green-600">{{ $todaySalesTotal ?? 'Rp 0' }}</strong>
                        </p>
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