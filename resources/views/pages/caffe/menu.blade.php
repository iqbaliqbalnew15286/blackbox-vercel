@extends('layouts.caffe')

@section('content')
    <section class="bg-black py-16 sm:py-24 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-400 tracking-tight">
                    <i class="fa-solid fa-fire-flame-curved mr-2"></i> OUR MENU
                </h1>
                <p class="mt-4 text-lg text-gray-400 max-w-2xl mx-auto">
                    Temukan berbagai pilihan menu favorit kami yang dibuat dengan cinta dan bahan berkualitas.
                </p>
            </div>

            {{-- TOMBOL KERANJANG TERAPUNG (FLOATING CART BUTTON) --}}
            <button id="open-cart-btn"
                class="fixed bottom-6 right-6 z-50 p-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center space-x-2 cursor-pointer">
                <i class="fa-solid fa-cart-shopping text-xl"></i>
                <span class="text-lg font-bold">Keranjang</span>
                {{-- Pastikan nilai awal di sini adalah 0 --}}
                <span id="cart-count"
                    class="bg-red-500 text-white text-xs font-extrabold w-6 h-6 flex items-center justify-center rounded-full">0</span>
            </button>


            {{-- NAVIGASI SECTION STICKY --}}
            <div class="sticky top-20 z-10 flex justify-center mb-12">
                <div class="glass-card rounded-full p-2 shadow-xl border border-white/10">
                    <div class="flex space-x-2">
                        <a href="#food"
                            class="nav-tab px-6 py-3 rounded-full font-semibold transition-all duration-300 bg-blue-600 text-white active-tab">Food</a>
                        <a href="#drinks"
                            class="nav-tab px-6 py-3 rounded-full font-semibold transition-all duration-300 text-gray-300 hover:text-blue-400 hover:bg-blue-600/20">Drinks</a>
                        <a href="#snacks"
                            class="nav-tab px-6 py-3 rounded-full font-semibold transition-all duration-300 text-gray-300 hover:text-blue-400 hover:bg-blue-600/20">Snacks</a>
                    </div>
                </div>
            </div>

            {{-- 1. SECTION FOOD --}}
            <div id="food" class="menu-section mb-16">
                <h2 class="text-4xl font-extrabold text-white mb-8 text-center border-b border-blue-400/20 pb-3">
                    <i class="fa-solid fa-utensils mr-2 text-blue-400"></i> Food
                </h2>
                @if (isset($foodItems) && $foodItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($foodItems as $item)
                            <div
                                class="menu-card glass-card rounded-2xl shadow-xl transition-all duration-300 overflow-hidden border border-white/10 transform hover:scale-[1.02]">
                                <div class="aspect-square relative overflow-hidden">
                                    @php
                                        $imageSrc = $item->photo ? asset('storage/' . $item->photo) : 'https://placehold.co/400x400/1e293b/94a3b8?text=' . urlencode($item->name);
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-5">
                                    <span
                                        class="inline-block bg-blue-600/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider border border-blue-400/30">
                                        {{ $item->category ?? 'Food' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-white mb-2 hover:text-blue-400 transition-colors">
                                        {{ $item->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $item->description ?? '-' }}</p>
                                    <div class="flex items-center justify-between mt-4">
                                        <span
                                            class="text-2xl font-extrabold text-blue-400">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                        {{-- DATA PENTING UNTUK JS - TOMBOL IKON BARU --}}
                                        <button data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-price="{{ $item->price }}"
                                            class="add-to-cart-btn bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full border-2 border-blue-400 text-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-10">Belum ada menu Food yang tersedia.</p>
                @endif
            </div>

            {{-- 2. SECTION DRINKS --}}
            <div id="drinks" class="menu-section mb-16">
                <h2 class="text-4xl font-extrabold text-white mb-8 text-center border-b border-blue-400/20 pb-3">
                    <i class="fa-solid fa-coffee mr-2 text-blue-400"></i> Drinks
                </h2>
                @if (isset($drinkItems) && $drinkItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($drinkItems as $item)
                            <div
                                class="menu-card glass-card rounded-2xl shadow-xl transition-all duration-300 overflow-hidden border border-white/10 transform hover:scale-[1.02]">
                                <div class="aspect-square relative overflow-hidden">
                                    @php
                                        $imageSrc = $item->photo ? asset('storage/' . $item->photo) : 'https://placehold.co/400x400/1e293b/94a3b8?text=' . urlencode($item->name);
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-5">
                                    <span
                                        class="inline-block bg-blue-600/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider border border-blue-400/30">
                                        {{ $item->category ?? 'Drink' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-white mb-2 hover:text-blue-400 transition-colors">
                                        {{ $item->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $item->description ?? '-' }}</p>
                                    <div class="flex items-center justify-between mt-4">
                                        <span
                                            class="text-2xl font-extrabold text-blue-400">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                        {{-- DATA PENTING UNTUK JS - TOMBOL IKON BARU --}}
                                        <button data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-price="{{ $item->price }}"
                                            class="add-to-cart-btn bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full border-2 border-blue-400 text-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-10">Belum ada menu Drinks yang tersedia.</p>
                @endif
            </div>

            {{-- 3. SECTION SNACKS --}}
            <div id="snacks" class="menu-section mb-16">
                <h2 class="text-4xl font-extrabold text-white mb-8 text-center border-b border-blue-400/20 pb-3">
                    <i class="fa-solid fa-cookie-bite mr-2 text-blue-400"></i> Snacks
                </h2>
                @if (isset($snackItems) && $snackItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($snackItems as $item)
                            <div
                                class="menu-card glass-card rounded-2xl shadow-xl transition-all duration-300 overflow-hidden border border-white/10 transform hover:scale-[1.02]">
                                <div class="aspect-square relative overflow-hidden">
                                    @php
                                        $imageSrc = $item->photo ? asset('storage/' . $item->photo) : 'https://placehold.co/400x400/1e293b/94a3b8?text=' . urlencode($item->name);
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-5">
                                    <span
                                        class="inline-block bg-blue-600/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider border border-blue-400/30">
                                        {{ $item->category ?? 'Snack' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-white mb-2 hover:text-blue-400 transition-colors">
                                        {{ $item->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $item->description ?? '-' }}</p>
                                    <div class="flex items-center justify-between mt-4">
                                        <span
                                            class="text-2xl font-extrabold text-blue-400">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                        {{-- DATA PENTING UNTUK JS - TOMBOL IKON BARU --}}
                                        <button data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-price="{{ $item->price }}"
                                            class="add-to-cart-btn bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full border-2 border-blue-400 text-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-10">Belum ada menu Snacks yang tersedia.</p>
                @endif
            </div>

        </div>
    </section>

    {{-- MODAL DAN STYLE SAMA PERSIS DENGAN SEBELUMNYA --}}
    <div id="cart-modal" class="fixed inset-0 bg-black/70 z-50 hidden transition-opacity duration-300 opacity-0">
        <div class="flex items-center justify-center min-h-screen">
            <div class="glass-card rounded-2xl w-full max-w-lg mx-4 p-6 shadow-2xl border border-blue-700/50 transform transition-all duration-300 scale-95 opacity-0"
                id="cart-content">

                <div class="flex justify-between items-center border-b border-white/10 pb-4 mb-4">
                    <h2 class="text-3xl font-extrabold text-blue-400 flex items-center">
                        <i class="fa-solid fa-shopping-basket mr-3"></i> Pesanan Anda
                    </h2>
                    <button id="close-cart-btn" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <div id="cart-items-container" class="space-y-4 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                    <p class="text-center text-gray-500 py-4" id="empty-cart-message">Keranjang masih kosong.</p>
                </div>

                <div class="mt-6 pt-4 border-t border-white/10">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-semibold text-white">Total Harga:</span>
                        <span class="text-3xl font-extrabold text-blue-400" id="cart-total-price">Rp0</span>
                    </div>

                    <button id="checkout-wa-btn" disabled
                        class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors duration-300 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fa-brands fa-whatsapp text-2xl mr-2"></i> Checkout via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1f2937;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }

        .glass-card {
            background-color: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    {{-- Awal: JavaScript Logika Keranjang (DIPERBAIKI) --}}
    <script>
        // Menggunakan let agar bisa di-reset
        let cart = {};
        const WHATSAPP_NUMBER = "6289502669582";

        // --- Helper Functions ---

        /** Format harga ke Rupiah */
        function formatRupiah(number) {
            if (typeof number === 'string') {
                number = parseInt(number);
            }
            return 'Rp' + number.toLocaleString('id-ID');
        }

        /** Membuka Modal Keranjang */
        function openCartModal() {
            const cartModal = document.getElementById('cart-modal');
            const cartContent = document.getElementById('cart-content');

            // Pastikan UI keranjang diupdate sebelum modal dibuka
            updateCartUI();

            cartModal.classList.remove('hidden');

            setTimeout(() => {
                cartModal.classList.add('opacity-100');
                cartModal.classList.remove('opacity-0');

                cartContent.classList.add('opacity-100', 'scale-100');
                cartContent.classList.remove('opacity-0', 'scale-95');
            }, 10);
        }

        /** Menutup Modal Keranjang */
        function closeCartModal() {
            const cartModal = document.getElementById('cart-modal');
            const cartContent = document.getElementById('cart-content');

            cartContent.classList.remove('opacity-100', 'scale-100');
            cartContent.classList.add('opacity-0', 'scale-95');

            cartModal.classList.remove('opacity-100');
            cartModal.classList.add('opacity-0');

            setTimeout(() => {
                cartModal.classList.add('hidden');
            }, 300);
        }

        /** Render item di dalam keranjang pop-up */
        function renderCartItem(item) {
            const itemTotal = item.price * item.qty;

            const itemElement = document.createElement('div');
            itemElement.className =
                'flex items-center justify-between p-3 bg-white/5 rounded-lg border border-white/10 cart-item';
            itemElement.setAttribute('data-id', item.id);
            itemElement.innerHTML = `
                <div class="w-1/2">
                    <h4 class="text-base font-semibold text-white">${item.name}</h4>
                    <p class="text-blue-400 text-sm font-medium">${formatRupiah(item.price)}/unit</p>
                </div>
                <div class="flex items-center space-x-2 w-1/2 justify-end">
                    <button class="qty-minus bg-red-600 hover:bg-red-700 text-white w-7 h-7 rounded-full text-sm font-bold transition-colors" data-id="${item.id}">-</button>
                    <span class="text-white text-lg font-bold w-5 text-center" id="qty-${item.id}">${item.qty}</span>
                    <button class="qty-plus bg-blue-600 hover:bg-blue-700 text-white w-7 h-7 rounded-full text-sm font-bold transition-colors" data-id="${item.id}">+</button>
                    <span class="text-white text-lg font-bold w-16 text-right">${formatRupiah(itemTotal)}</span>
                    <button class="qty-remove text-red-500 hover:text-red-400 ml-4 transition-colors" data-id="${item.id}" title="Hapus Item">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;
            return itemElement;
        }

        /** * Update seluruh tampilan keranjang dan total.
         * Fungsi ini PENTING karena bertanggung jawab memperbarui:
         * 1. Daftar Item dalam Modal
         * 2. Total Harga dalam Modal
         * 3. Angka pada Floating Cart Button (cart-count)
         */
        function updateCartUI() {
            const container = document.getElementById('cart-items-container');
            const totalElement = document.getElementById('cart-total-price');
            const countElement = document.getElementById('cart-count');
            const emptyMessage = document.getElementById('empty-cart-message');
            const checkoutBtn = document.getElementById('checkout-wa-btn');

            let total = 0;
            let totalCount = 0;
            container.innerHTML = ''; // Clear existing items

            const cartItemsArray = Object.values(cart);

            if (cartItemsArray.length === 0) {
                emptyMessage.style.display = 'block';
                checkoutBtn.setAttribute('disabled', 'true');
            } else {
                emptyMessage.style.display = 'none';
                checkoutBtn.removeAttribute('disabled');

                cartItemsArray.forEach(item => {
                    if (item && item.id && item.name && item.price >= 0 && item.qty > 0) {
                        container.appendChild(renderCartItem(item));
                        total += item.price * item.qty;
                        totalCount += item.qty;
                    } else {
                        // Hapus item yang qty-nya nol atau kurang
                        delete cart[item.id];
                    }
                });
            }

            // Memperbarui Total Harga
            totalElement.textContent = formatRupiah(total);

            // Memperbarui Angka di Floating Button (point 3)
            countElement.textContent = totalCount;

            // Simpan status keranjang ke localStorage
            localStorage.setItem('menuCart', JSON.stringify(cart));
        }

        /** Tambahkan item ke keranjang */
        function addToCart(id, name, price) {
            id = parseInt(id);
            price = parseInt(price);

            if (cart[id]) {
                // Item sudah ada, tambahkan kuantitas
                cart[id].qty += 1;
            } else {
                // Item baru, tambahkan ke keranjang (point 4)
                cart[id] = {
                    id,
                    name,
                    price,
                    qty: 1
                };
            }
            // PENTING: Panggil updateCartUI untuk memperbarui tampilan
            updateCartUI();
        }

        /** Mengosongkan keranjang */
        function clearCart() {
            cart = {};
            localStorage.removeItem('menuCart');
            updateCartUI();
        }


        // --- Inisialisasi ---

        function loadCart() {
            const savedCart = localStorage.getItem('menuCart');
            if (savedCart) {
                try {
                    const parsedCart = JSON.parse(savedCart);
                    // Pastikan konversi tipe data terjadi saat load
                    for (const id in parsedCart) {
                        if (parsedCart.hasOwnProperty(id)) {
                            cart[id] = {
                                id: parseInt(parsedCart[id].id),
                                name: parsedCart[id].name,
                                price: parseInt(parsedCart[id].price),
                                qty: parseInt(parsedCart[id].qty)
                            };
                        }
                    }
                } catch (e) {
                    console.error("Error parsing cart from localStorage:", e);
                    localStorage.removeItem('menuCart');
                    cart = {};
                }
            }
            // PENTING: Panggil updateCartUI saat load untuk memastikan cart-count menampilkan nilai yang benar (point 1)
            updateCartUI();
        }
        loadCart();

        // --- Event Listeners ---

        // 1. Tombol 'Tambahkan Keranjang' (FUNGSI UTAMA)
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            const originalIcon = '<i class="fa-solid fa-cart-shopping"></i>'; // Ikon Asli
            const successIcon = '<i class="fa-solid fa-check"></i>'; // Ikon Sukses

            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');

                // Menambahkan item dan memperbarui count (di dalam addToCart -> updateCartUI)
                addToCart(id, name, price);

                // Visual feedback (diperbarui untuk ikon saja)
                this.innerHTML = successIcon;
                this.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'border-blue-400');
                this.classList.add('bg-green-600', 'hover:bg-green-700', 'border-green-400');

                // Reset setelah 1 detik
                setTimeout(() => {
                    this.innerHTML = originalIcon;
                    this.classList.remove('bg-green-600', 'hover:bg-green-700', 'border-green-400');
                    this.classList.add('bg-blue-600', 'hover:bg-blue-700', 'border-blue-400');
                }, 1000);

                // Buka keranjang otomatis jika ini item pertama
                if (Object.keys(cart).length === 1) {
                    openCartModal();
                }
            });
        });


        // 2. Quantity Control dan Remove dari Cart (Delegasi Event)
        document.getElementById('cart-items-container').addEventListener('click', function(e) {
            const target = e.target;
            let isPlus = target.closest('.qty-plus');
            let isMinus = target.closest('.qty-minus');
            let isRemove = target.closest('.qty-remove');

            let button;
            if (isPlus) button = isPlus;
            else if (isMinus) button = isMinus;
            else if (isRemove) button = isRemove;

            if (!button) return;

            const id = parseInt(button.getAttribute('data-id'));

            if (!id || !cart[id]) return;

            if (isPlus) {
                cart[id].qty += 1;
            } else if (isMinus) {
                cart[id].qty -= 1;
                if (cart[id].qty <= 0) {
                    delete cart[id];
                }
            } else if (isRemove) {
                delete cart[id];
            }

            // Panggil updateCartUI untuk me-render ulang seluruh keranjang
            updateCartUI();

            // Tutup modal jika keranjang kosong
            if (Object.keys(cart).length === 0) {
                closeCartModal();
            }
        });

        // 3. Modal Controls
        document.getElementById('open-cart-btn').addEventListener('click', openCartModal);

        document.getElementById('close-cart-btn').addEventListener('click', closeCartModal);

        document.getElementById('cart-modal').addEventListener('click', function(e) {
            if (e.target.id === 'cart-modal') {
                closeCartModal();
            }
        });

        // 4. Checkout via WhatsApp (TIDAK ME-RESET KERANJANG)
        document.getElementById('checkout-wa-btn').addEventListener('click', function() {
            const items = Object.values(cart);
            if (items.length === 0) return;

            let message = "Halo, Blackbox Café!\nSaya ingin memesan menu berikut (Pembayaran CASH):\n\n";
            let total = 0;

            items.forEach((item, index) => {
                const itemTotal = item.price * item.qty;
                total += itemTotal;
                message +=
                    `${index + 1}. ${item.name} (${item.qty}x) @ ${formatRupiah(item.price)} = ${formatRupiah(itemTotal)}\n`;
            });

            message += `\n*TOTAL HARGA: ${formatRupiah(total)}*\n`;
            message += "\nMohon konfirmasi pesanan saya. Terima kasih!";

            const encodedMessage = encodeURIComponent(message);
            const waLink = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodedMessage}`;

            // **PERBAIKAN: Hanya menutup modal, TIDAK mereset keranjang**
            closeCartModal();

            // Buka link WA
            window.open(waLink, '_blank');
        });

        // 5. Sticky Navigation Tabs (Scroll Logic)
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelectorAll('.nav-tab').forEach(t => {
                    t.classList.remove('bg-blue-600', 'text-white');
                    t.classList.add('text-gray-300', 'hover:text-blue-400', 'hover:bg-blue-600/20');
                });

                this.classList.remove('text-gray-300', 'hover:text-blue-400', 'hover:bg-blue-600/20');
                this.classList.add('bg-blue-600', 'text-white');

                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navElement = document.querySelector('.sticky');
                    const navHeight = navElement ? navElement.offsetHeight : 0;
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY - (
                        navHeight + 20);

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // 6. Intersection Observer
        const observerOptions = {
            root: null,
            rootMargin: '-30% 0px -60% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');

                    document.querySelectorAll('.nav-tab').forEach(tab => {
                        tab.classList.remove('bg-blue-600', 'text-white');
                        tab.classList.add('text-gray-300', 'hover:text-blue-400',
                            'hover:bg-blue-600/20');
                    });

                    const activeTab = document.querySelector(`.nav-tab[href="#${id}"]`);
                    if (activeTab) {
                        activeTab.classList.remove('text-gray-300', 'hover:text-blue-400',
                            'hover:bg-blue-600/20');
                        activeTab.classList.add('bg-blue-600', 'text-white');
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.menu-section').forEach(section => {
            observer.observe(section);
        });
    </script>
@endsection
