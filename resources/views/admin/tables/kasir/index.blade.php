{{-- resources/views/kasir/index.blade.php --}}
@extends('layouts.admin-app')

@section('title', 'Kasir Café Warghe')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web/dist/phosphor.css">

    <div class="min-h-screen bg-gray-100 text-gray-900 py-8 px-6 transition-colors duration-300">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT (2 columns) - Menu --}}
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-amber-900">Kasir Caffe Warghe</h1>
                        <p class="text-amber-800 mt-1">Pilih menu → tambah ke keranjang.</p>
                    </div>

                    <div class="w-64">
                        <input id="searchInput" type="text" placeholder="Cari menu..."
                            class="w-full rounded-lg px-3 py-2 bg-white border border-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                            oninput="searchMenu()">
                    </div>
                </div>

                {{-- Menu Items --}}
                @php
                    $categories = $menuItems->pluck('category')->unique();
                @endphp
                @foreach ($categories as $category)
                    <h2 class="text-xl font-semibold mb-3 text-amber-900">{{ $category }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6"
                        id="menu-{{ strtolower(str_replace(' ', '-', $category)) }}">
                        @foreach ($menuItems->where('category', $category) as $item)
                            <div class="product-card bg-white border border-gray-300 rounded-xl overflow-hidden group shadow-sm hover:shadow-md transition-shadow flex flex-col h-full"
                                data-name="{{ strtolower($item->name) }}" data-id="{{ $item->id }}"
                                data-base-price="{{ $item->price }}">
                                <div
                                    class="h-28 bg-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if ($item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="text-gray-500">No Image</div>
                                    @endif
                                </div>

                                <div class="p-3 flex flex-col flex-grow">
                                    <h3 class="font-semibold text-gray-900 truncate">{{ $item->name }}</h3>
                                    @if ($item->description)
                                        <p class="text-gray-600 text-sm mt-1 line-clamp-2 flex-grow">
                                            {{ $item->description }}</p>
                                    @else
                                        <div class="flex-grow"></div>
                                    @endif
                                    <div class="mt-auto">
                                        <p class="text-amber-600 font-semibold">Rp
                                            {{ number_format($item->price, 0, ',', '.') }}</p>

                                        <button type="button"
                                            class="mt-2 w-full add-no-variant inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-blue-800 text-white font-semibold hover:bg-blue-900">
                                            <i class="ph ph-shopping-cart"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach


            </div>

            {{-- RIGHT - Keranjang & Pembayaran --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-lg lg:self-start">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Keranjang</h2>

                {{-- Current Kasir Info --}}
                <div class="mb-4 bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-500 text-white rounded-full p-2">
                                <i class="ph ph-user text-lg"></i>
                            </div>
                            <div>
                                <div class="text-sm text-blue-600">Kasir Aktif</div>
                                <div class="font-semibold text-gray-900" id="currentKasirName">
                                    @php
                                        $activeKasirId = session('active_kasir_id', Auth::id());
                                        $currentKasir = \App\Models\User::find($activeKasirId);
                                        echo $currentKasir ? $currentKasir->name : 'Pilih Kasir';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <button type="button" id="changeKasirBtn"
                            class="px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white rounded-lg font-semibold transition">
                            <i class="ph ph-arrows-clockwise mr-2"></i>Ganti Kasir
                        </button>
                    </div>
                </div>

                {{-- Hidden Cashier Selection --}}
                <div class="mb-4 hidden" id="kasirSelectionDiv">
                    <label class="block text-sm text-gray-600 mb-2 font-medium">Pilih Kasir Baru</label>
                    <select name="kasir_id" id="kasir_id"
                        class="w-full rounded-lg px-3 py-2 bg-white border border-gray-300 text-gray-900" required>
                        <option value="">-- Pilih Kasir --</option>
                        @foreach (\App\Models\User::where('role', 'kasir')->get() as $kasir)
                            <option value="{{ $kasir->id }}"
                                {{ session('active_kasir_id', Auth::id()) == $kasir->id ? 'selected' : '' }}>
                                {{ $kasir->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-2 flex gap-2">
                        <button type="button" id="confirmKasirBtn"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold">
                            Konfirmasi
                        </button>
                        <button type="button" id="cancelKasirBtn"
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-semibold">
                            Batal
                        </button>
                    </div>
                </div>

                <form id="formTransaksi" action="{{ route('admin.kasir.store') }}" method="POST">
                    @csrf

                    {{-- Daftar item --}}
                    <div id="cartItems" class="space-y-3 min-h-[150px] max-h-72 overflow-y-auto mb-4">
                        <div id="emptyCart" class="text-center text-gray-500 py-8">
                            <i class="ph ph-shopping-cart-simple text-3xl mb-2"></i>
                            <div>Keranjang kosong</div>
                        </div>
                    </div>

                    <div class="border-t border-gray-300 pt-4 space-y-3">
                        {{-- TOTAL DISPLAY --}}
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Total:</span>
                            <span id="totalDisplay" class="text-2xl font-bold text-gray-900">Rp 0</span>
                        </div>

                        <input type="hidden" name="total_belanja" id="total_belanja" value="0">
                        <input type="hidden" name="cart_items" id="cart_items">
                        <input type="hidden" name="action" id="action" value="sukses">

                        {{-- Jumlah Bayar (Quick buttons) --}}
                        <div class="mt-3">
                            <label class="block text-sm text-gray-600 mb-2 font-medium">Jumlah Bayar (Tunai)</label>

                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <button type="button" data-amount="10000"
                                    class="quick-money w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 font-semibold">+10K</button>
                                <button type="button" data-amount="20000"
                                    class="quick-money w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 font-semibold">+20K</button>
                                <button type="button" data-amount="50000"
                                    class="quick-money w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 font-semibold">+50K</button>
                                <button type="button" data-amount="100000"
                                    class="quick-money w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 font-semibold">+100K</button>
                                <button type="button" id="exactBtn"
                                    class="col-span-2 w-full bg-blue-700 hover:bg-blue-800 text-white rounded-lg py-2 font-semibold">Uang
                                    Pas</button>
                            </div>

                            <input type="number" name="jumlah_bayar" id="jumlah_bayar"
                                class="w-full rounded-lg px-3 py-2 bg-white border border-gray-300 text-gray-900"
                                value="0" min="0" required>
                        </div>

                        {{-- Subtotal --}}
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Subtotal:</span>
                            <span id="subtotalDisplay" class="font-semibold text-gray-900">Rp 0</span>
                        </div>

                        {{-- Metode Pembayaran --}}
                        <div class="mt-3 bg-blue-50 p-4 rounded-lg border border-blue-200 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-500 text-white rounded-full p-2">
                                        <i class="ph ph-cash text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-blue-600">Metode Pembayaran</div>
                                        <div class="font-semibold text-gray-900">Tunai</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-blue-600">Kembalian</div>
                                    <div id="changeDisplay" class="text-lg font-bold text-green-600">Rp 0</div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="mt-4">
                            <button type="submit" id="submitButton"
                                class="w-full py-3 rounded-lg bg-blue-800 hover:bg-blue-900 text-white font-bold disabled:opacity-60"
                                disabled>
                                <i class="ph ph-receipt mr-2"></i> Simpan & Cetak Struk
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // === Helper ===
        function formatIDR(num) {
            return (parseInt(num) || 0).toLocaleString('id-ID');
        }

        function escapeHtml(unsafe) {
            // safe small escaper
            return String(unsafe)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // === DOM refs (declare but initialize inside DOMContentLoaded) ===
        let cartItemsEl, emptyCartEl, subtotalDisplay, totalDisplay, totalBelanjaInput, cartItemsInput, jumlahBayarInput,
            changeDisplay, submitButton;

        let cart = [];

        function genUID(id, variant) {
            return id + '::' + (variant ?? '___default___');
        }

        function searchMenu() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.product-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                if (name.toLowerCase().includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function addToCart({
            id,
            name,
            variant = null,
            price = 0
        }) {
            price = parseInt(price) || 0;
            const uid = genUID(id, variant);
            const existing = cart.find(i => i.uid === uid);
            if (existing) {
                existing.qty = parseInt(existing.qty) + 1;
            } else {
                cart.push({
                    uid,
                    id: parseInt(id),
                    name,
                    variant,
                    price,
                    qty: 1
                });
            }
            renderCart();
        }

        function renderCart() {
            cartItemsEl.innerHTML = '';
            if (!cart.length) {
                cartItemsEl.appendChild(emptyCartEl);
                emptyCartEl.style.display = 'block';
                subtotalDisplay.textContent = 'Rp 0';
                totalDisplay.textContent = 'Rp 0';
                totalBelanjaInput.value = 0;
                cartItemsInput.value = '';
                updatePaymentState();
                return;
            }
            emptyCartEl.style.display = 'none';

            let total = 0;

            cart.forEach((item, idx) => {
                const subtotal = item.price * item.qty;
                total += subtotal;

                const row = document.createElement('div');
                row.className =
                    'flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg p-3';
                row.innerHTML = `
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                          <div class="truncate">
                            <div class="font-semibold text-gray-900">${escapeHtml(item.name)}</div>
                            <div class="text-xs text-gray-500">Rp ${formatIDR(item.price)} × ${item.qty}</div>
                          </div>
                        <div class="text-right ml-3">
                          <div class="font-medium text-gray-900">Rp ${formatIDR(subtotal)}</div>
                          <div class="flex items-center justify-end gap-2 mt-2">
                            <button data-idx="${idx}" class="decrease text-xs px-2 py-1 bg-gray-200 rounded text-gray-600">-</button>
                            <span class="px-2 text-sm text-gray-900">${item.qty}</span>
                            <button data-idx="${idx}" class="increase text-xs px-2 py-1 bg-gray-200 rounded text-gray-600">+</button>
                            <button data-idx="${idx}" class="remove text-xs px-2 py-1 text-red-500">hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>`;
                cartItemsEl.appendChild(row);
            });

            // update totals and hidden inputs
            subtotalDisplay.textContent = 'Rp ' + formatIDR(total);
            totalDisplay.textContent = 'Rp ' + formatIDR(total);
            totalBelanjaInput.value = total;
            cartItemsInput.value = JSON.stringify(cart);

            // attach handlers for newly created elements
            cartItemsEl.querySelectorAll('.increase').forEach(btn => {
                btn.addEventListener('click', () => {
                    const i = parseInt(btn.getAttribute('data-idx'));
                    cart[i].qty = parseInt(cart[i].qty) + 1;
                    renderCart();
                });
            });
            cartItemsEl.querySelectorAll('.decrease').forEach(btn => {
                btn.addEventListener('click', () => {
                    const i = parseInt(btn.getAttribute('data-idx'));
                    cart[i].qty = Math.max(1, parseInt(cart[i].qty) - 1);
                    renderCart();
                });
            });
            cartItemsEl.querySelectorAll('.remove').forEach(btn => {
                btn.addEventListener('click', () => {
                    const i = parseInt(btn.getAttribute('data-idx'));
                    cart.splice(i, 1);
                    renderCart();
                });
            });

            updatePaymentState();
        }

        function updateChange() {
            const bayar = parseInt(jumlahBayarInput.value) || 0;
            const total = parseInt(totalBelanjaInput.value) || 0;
            const change = Math.max(0, bayar - total);
            changeDisplay.textContent = 'Rp ' + formatIDR(change);
            submitButton.disabled = (total === 0) || (bayar < total);
        }

        function updatePaymentState() {
            updateChange();
        }

        // Wait DOM ready so querySelectorAll works reliably
        document.addEventListener('DOMContentLoaded', () => {
            // init DOM refs
            cartItemsEl = document.getElementById('cartItems');
            emptyCartEl = document.getElementById('emptyCart');
            subtotalDisplay = document.getElementById('subtotalDisplay');
            totalDisplay = document.getElementById('totalDisplay');
            totalBelanjaInput = document.getElementById('total_belanja');
            cartItemsInput = document.getElementById('cart_items');
            jumlahBayarInput = document.getElementById('jumlah_bayar');
            changeDisplay = document.getElementById('changeDisplay');
            submitButton = document.getElementById('submitButton');

            // Attach add-to-cart handlers
            document.querySelectorAll('.add-no-variant').forEach(btn => {
                btn.addEventListener('click', () => {
                    const card = btn.closest('.product-card');
                    const id = card.getAttribute('data-id');
                    const name = card.getAttribute('data-name');
                    const price = parseInt(card.getAttribute('data-base-price') || 0);
                    addToCart({
                        id,
                        name,
                        variant: null,
                        price
                    });
                });
            });

            // quick-money buttons
            document.querySelectorAll('.quick-money').forEach(b => {
                b.addEventListener('click', () => {
                    const amount = parseInt(b.getAttribute('data-amount')) || 0;
                    const current = parseInt(jumlahBayarInput.value) || 0;
                    jumlahBayarInput.value = current + amount;
                    updateChange();
                });
            });

            // exact (uang pas)
            const exactBtn = document.getElementById('exactBtn');
            exactBtn?.addEventListener('click', () => {
                const total = parseInt(totalBelanjaInput.value) || 0;
                jumlahBayarInput.value = total;
                updateChange();
            });

            // update change when typing
            jumlahBayarInput.addEventListener('input', updateChange);

            // form submit -> show success modal then submit
            document.getElementById('formTransaksi').addEventListener('submit', function(e) {
                e.preventDefault();

                if (!cart.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Keranjang kosong!',
                        text: 'Tambahkan produk terlebih dahulu.'
                    });
                    return;
                }

                const total = parseInt(totalBelanjaInput.value) || 0;
                const bayar = parseInt(jumlahBayarInput.value) || 0;
                if (bayar < total) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Uang kurang',
                        text: 'Jumlah bayar kurang dari total.'
                    });
                    return;
                }

                // Show modal
                Swal.fire({
                    width: 600,
                    background: '#0b1220',
                    showConfirmButton: false,
                    html: `
                        <div style="color:#fff; text-align:center; padding:20px;">
                            <div style="display:flex; justify-content:center; margin-bottom:16px;">
                                <div style="width:60px; height:60px; border-radius:50%; background:#10b981; display:flex; align-items:center; justify-content:center; animation: bounce 1s infinite;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; height:30px; color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <h2 style="font-size:24px; font-weight:700; margin-bottom:8px;">Transaksi Berhasil</h2>
                            <div style="opacity:0.85; margin-bottom:16px;">Total Tagihan: Rp ${formatIDR(total)}</div>

                            <div style="background:#071027; padding:14px; border-radius:8px; margin-bottom:16px; text-align:left;">
                                <h3 style="font-weight:600; margin-bottom:8px; color:#fff;">Menu:</h3>
                                ${cart.map(item => `
                                                                                                                                                                                                                                    <div style="display:flex; justify-content:space-between; margin-bottom:4px; color:#9ca3af;">
                                                                                                                                                                                                                                        <span>${escapeHtml(item.name)} × ${item.qty}</span>
                                                                                                                                                                                                                                        <span>Rp ${formatIDR(item.price * item.qty)}</span>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                `).join('')}
                            </div>

                            <div style="display:flex; gap:12px;">
                                <button id="btnViewStruk" style="flex:1; background:#111827; color:white; padding:12px; border-radius:8px; font-weight:700; border:none; cursor:pointer;">Lihat Struk</button>
                                <button id="btnSelesai" style="flex:1; background:#10b981; color:white; padding:12px; border-radius:8px; font-weight:700; border:none; cursor:pointer;">Selesai</button>
                            </div>
                        </div>
                        <style>
                            @keyframes bounce {
                                0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
                                40% { transform: translateY(-10px); }
                                60% { transform: translateY(-5px); }
                            }
                        </style>
                    `
                });

                // attach actions after SweetAlert created
                setTimeout(() => {
                    const btnSelesai = document.getElementById('btnSelesai');
                    const btnViewStruk = document.getElementById('btnViewStruk');

                    btnSelesai?.addEventListener('click', () => {
                        cartItemsInput.value = JSON.stringify(cart);
                        document.getElementById('action').value = 'sukses';
                        document.getElementById('formTransaksi').submit();
                    });

                    btnViewStruk?.addEventListener('click', () => {
                        cartItemsInput.value = JSON.stringify(cart);
                        document.getElementById('action').value = 'struk';
                        document.getElementById('formTransaksi').submit();
                    });
                }, 200);
            });

            // Kasir change functionality
            const changeKasirBtn = document.getElementById('changeKasirBtn');
            const kasirSelectionDiv = document.getElementById('kasirSelectionDiv');
            const confirmKasirBtn = document.getElementById('confirmKasirBtn');
            const cancelKasirBtn = document.getElementById('cancelKasirBtn');
            const currentKasirName = document.getElementById('currentKasirName');
            const kasirSelect = document.getElementById('kasir_id');

            changeKasirBtn?.addEventListener('click', () => {
                kasirSelectionDiv.classList.remove('hidden');
                changeKasirBtn.style.display = 'none';
            });

            cancelKasirBtn?.addEventListener('click', () => {
                kasirSelectionDiv.classList.add('hidden');
                changeKasirBtn.style.display = 'block';
                kasirSelect.value = kasirSelect.querySelector('option[selected]')?.value || '';
            });

            confirmKasirBtn?.addEventListener('click', () => {
                const selectedOption = kasirSelect.options[kasirSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    // Send AJAX request to update session
                    fetch('/kasir/change-kasir', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                kasir_id: selectedOption.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                currentKasirName.textContent = selectedOption.text;
                                kasirSelectionDiv.classList.add('hidden');
                                changeKasirBtn.style.display = 'block';

                                // Show success message
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Kasir Berubah',
                                    text: `Kasir aktif sekarang: ${selectedOption.text}`,
                                    background: '#0b1220',
                                    color: '#fff',
                                    confirmButtonColor: '#10b981'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal mengubah kasir.',
                                    background: '#0b1220',
                                    color: '#fff',
                                    confirmButtonColor: '#ef4444'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengubah kasir.',
                                background: '#0b1220',
                                color: '#fff',
                                confirmButtonColor: '#ef4444'
                            });
                        });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Kasir',
                        text: 'Silakan pilih kasir terlebih dahulu.',
                        background: '#0b1220',
                        color: '#fff',
                        confirmButtonColor: '#f59e0b'
                    });
                }
            });

            // initial render
            renderCart();
        });
    </script>
@endsection
