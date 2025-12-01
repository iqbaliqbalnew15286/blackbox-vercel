@extends('layouts.salon')

@section('title', 'Booking Janji Temu - Elegance Salon & Spa')

@push('styles')
    {{-- Custom styles untuk Booking Form (CSS tidak ada perubahan, sudah baik) --}}
    <style>
        .step-nav-item {
            position: relative;
            padding: 10px 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 4px solid transparent;
        }

        .step-nav-item.active {
            color: var(--salon-pink);
            border-bottom-color: var(--salon-pink);
        }

        /* Gaya untuk card waktu (simulasi ketersediaan) */
        .time-slot {
            transition: all 0.2s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .time-slot:hover {
            background-color: var(--salon-pink);
            color: white;
            box-shadow: 0 2px 8px rgba(219, 39, 128, 0.2);
        }
        .time-slot.selected {
            background-color: var(--dark-accent);
            color: white;
            border: 2px solid var(--salon-pink);
            font-weight: 700;
        }
        .time-slot.disabled {
            background-color: #f1f1f1;
            color: #999;
            cursor: not-allowed;
            opacity: 0.8;
            text-decoration: line-through;
        }
    </style>
@endpush

@section('content')

    {{-- Hero Section Booking --}}
    <section class="py-20 bg-cream text-center border-b-4 border-salon-pink">
        <div class="container mx-auto px-6 lg:px-12">
            <h1 class="text-4xl font-extrabold text-dark-accent mb-2 font-elegant">Buat Janji Temu</h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Isi formulir di bawah ini, dan kirim konfirmasi melalui WhatsApp kami.</p>
        </div>
    </section>

    {{-- Booking Form Container --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 lg:px-12 max-w-4xl">

            {{-- STEPPER NAVIGATION (Visual) --}}
            <div class="flex justify-between items-center mb-10 border-b border-gray-200">
                <div id="step-1-nav" class="step-nav-item active">
                    <span class="md:inline hidden">Langkah 1:</span> Pilih Layanan
                </div>
                <div id="step-2-nav" class="step-nav-item">
                    <span class="md:inline hidden">Langkah 2:</span> Pilih Jadwal
                </div>
                <div id="step-3-nav" class="step-nav-item">
                    <span class="md:inline hidden">Langkah 3:</span> Data Diri & Kirim
                </div>
            </div>

            <form id="booking-form" onsubmit="return false;">

                {{-- STEP 1: PILIH LAYANAN (Mengambil data dari CMS) --}}
                <div id="step-1" class="step-content">
                    <h2 class="text-2xl font-bold text-dark-accent mb-6">1. Pilih Layanan Anda</h2>
                    <p class="text-gray-600 mb-6">Pilih layanan utama yang ingin Anda pesan. Anda bisa memilih lebih dari satu.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- ************************************************* --}}
                        {{-- * LOGIKA PENGAMBILAN DATA DARI CONTROLLER/CMS * --}}
                        {{-- ************************************************* --}}
                        @forelse ($services as $service)
                            <label class="block bg-cream p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300 border border-gray-200 cursor-pointer">

                                {{-- Hidden Checkbox --}}
                                <input type="checkbox" name="selected_services" value="{{ $service->name }}"
                                    {{-- Menggunakan data-price_raw untuk harga bersih tanpa format --}}
                                    data-price_raw="{{ $service->price }}"
                                    class="absolute opacity-0 pointer-events-none service-checkbox">

                                <div class="flex items-start space-x-3">
                                    {{-- Foto Layanan --}}
                                    @if(isset($service->photo) && $service->photo)
                                        <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}"
                                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                            onerror="this.onerror=null;this.src='https://placehold.co/64x64/E0E0E0/333333?text=Foto';">
                                    @else
                                        <div class="w-16 h-16 bg-salon-pink/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-spa text-xl text-salon-pink"></i>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <span class="text-dark-accent font-bold truncate">{{ $service->name }}</span>

                                            {{-- Harga Tampil --}}
                                            <span class="text-lg font-extrabold text-salon-pink flex-shrink-0 ml-4">
                                                Rp{{ number_format($service->price, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        {{-- Deskripsi dan Kategori --}}
                                        @if(isset($service->description) && $service->description)
                                            <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ Str::limit($service->description, 70) }}</p>
                                        @endif
                                        @if(isset($service->category) && $service->category)
                                            <span class="text-xs bg-dark-accent text-white px-2 py-0.5 rounded-full mt-2 inline-block">{{ $service->category }}</span>
                                        @endif

                                    </div>

                                    {{-- Visual Checked State --}}
                                    <div class="w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center ml-auto checked-indicator transition duration-300">
                                        <i class="fas fa-check text-white text-xs opacity-0"></i>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="col-span-full text-center py-8 bg-cream rounded-lg">
                                <p class="text-gray-500"><i class="fas fa-exclamation-circle mr-2"></i> Belum ada layanan tersedia untuk booking saat ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <p class="text-xl font-bold text-dark-accent">Total Estimasi: <span id="total-price" class="text-salon-pink">Rp 0</span></p>
                        <button type="button" onclick="nextStep(2)" class="bg-salon-pink text-white font-bold py-3 px-8 rounded-full hover:bg-dark-accent transition duration-300 shadow-lg disabled:opacity-50" disabled id="next-step-1">
                            Lanjut ke Jadwal <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                {{-- STEP 2: PILIH JADWAL (Tidak ada perubahan di HTML) --}}
                <div id="step-2" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-dark-accent mb-6">2. Pilih Tanggal dan Waktu</h2>

                    {{-- Pilihan Tanggal --}}
                    <div class="mb-8">
                        <label for="booking_date" class="block text-dark-accent font-semibold mb-2">Pilih Tanggal</label>
                        <input type="date" id="booking_date" name="booking_date"
                            class="w-full md:w-1/2 p-3 border border-gray-300 rounded-lg focus:border-salon-pink focus:ring-salon-pink"
                            min="{{ date('Y-m-d') }}" required>
                    </div>

                    {{-- Pilihan Waktu (Simulasi) --}}
                    <div class="mb-8">
                        <label class="block text-dark-accent font-semibold mb-3">Pilih Waktu (Tersedia)</label>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            @php
                                $timeSlots = ['09:00', '10:30', '12:00', '13:30', '15:00', '16:30', '18:00'];
                            @endphp

                            @foreach ($timeSlots as $slot)
                                <div class="time-slot bg-cream text-dark-accent p-3 rounded-lg text-center font-medium" data-time="{{ $slot }}">
                                    {{ $slot }}
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="booking_time" name="booking_time" required>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep(1)" class="text-dark-accent font-bold py-3 px-8 rounded-full hover:text-salon-pink transition duration-300">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="button" onclick="nextStep(3)" class="bg-salon-pink text-white font-bold py-3 px-8 rounded-full hover:bg-dark-accent transition duration-300 shadow-lg disabled:opacity-50" disabled id="next-step-2">
                            Lanjut ke Data Diri <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                {{-- STEP 3: DATA DIRI & KONFIRMASI (Tidak ada perubahan di HTML) --}}
                <div id="step-3" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-dark-accent mb-6">3. Data Diri & Konfirmasi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="name" class="block text-dark-accent font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:border-salon-pink focus:ring-salon-pink" required>
                        </div>
                        <div>
                            <label for="phone" class="block text-dark-accent font-semibold mb-2">Nomor WhatsApp</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:border-salon-pink focus:ring-salon-pink"
                                placeholder="Contoh: 0812345678" required>
                            <p class="text-xs text-gray-500 mt-1">Kami akan menghubungi Anda melalui nomor ini.</p>
                        </div>
                    </div>

                    {{-- Summary Box --}}
                    <div class="bg-cream p-6 rounded-xl border border-salon-pink/50 mb-8">
                        <h3 class="text-xl font-bold text-dark-accent mb-3"><i class="fas fa-check-circle text-salon-pink mr-2"></i> Detail Booking Anda</h3>
                        <p class="text-sm text-gray-600 mb-2">Layanan: <span id="summary-services" class="font-bold text-dark-accent"></span></p>
                        <p class="text-sm text-gray-600 mb-2">Tanggal: <span id="summary-date" class="font-bold text-dark-accent"></span></p>
                        <p class="text-sm text-gray-600 mb-2">Waktu: <span id="summary-time" class="font-bold text-dark-accent"></span></p>
                        <p class="text-lg font-extrabold mt-3 pt-3 border-t border-gray-300">Total Biaya: <span id="summary-price" class="text-salon-pink"></span></p>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep(2)" class="text-dark-accent font-bold py-3 px-8 rounded-full hover:text-salon-pink transition duration-300">
                            <i class="fas fa-arrow-left mr-2"></i> Koreksi Jadwal
                        </button>

                        {{-- Tombol Final ke WhatsApp --}}
                        <button type="submit" onclick="redirectToWhatsApp()" class="bg-[#25D366] text-white font-bold py-3 px-8 rounded-full hover:bg-[#128C7E] transition duration-300 shadow-xl">
                            <i class="fa-brands fa-whatsapp mr-2"></i> Kirim Booking via WhatsApp
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // --- STATE MANAGEMENT ---
    let currentStep = 1;
    const totalSteps = 3;
    const steps = document.querySelectorAll('.step-content');
    const navItems = document.querySelectorAll('.step-nav-item');
    const whatsappNumber = '6289502669582'; // Nomor WA Anda

    // --- STEP NAVIGATION LOGIC ---
    function updateStepDisplay() {
        steps.forEach((step, index) => {
            step.classList.toggle('hidden', index + 1 !== currentStep);
        });

        navItems.forEach((nav, index) => {
            nav.classList.remove('active');
            if (index + 1 === currentStep) {
                nav.classList.add('active');
            }
        });

        // Update Summary di Step 3
        if (currentStep === 3) {
            updateSummary();
        }
    }

    function nextStep(step) {
        if (validateStep(step - 1)) {
            currentStep = step;
            updateStepDisplay();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function prevStep(step) {
        currentStep = step;
        updateStepDisplay();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // --- VALIDATION & BUTTON TOGGLE ---

    // Step 1: Services Validation
    const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    const nextStep1Btn = document.getElementById('next-step-1');
    const totalPriceSpan = document.getElementById('total-price');

    // Menambahkan fungsi untuk styling visual saat checkbox dipilih
    const serviceLabels = document.querySelectorAll('.step-content label');

    serviceLabels.forEach(label => {
        const checkbox = label.querySelector('.service-checkbox');
        const indicator = label.querySelector('.checked-indicator');

        if (checkbox) {
            // Initial check
            if (checkbox.checked) {
                label.classList.add('border-salon-pink');
                if (indicator) {
                    indicator.classList.add('bg-salon-pink');
                    indicator.querySelector('i').classList.remove('opacity-0');
                }
            }

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    label.classList.add('border-salon-pink');
                    if (indicator) {
                        indicator.classList.add('bg-salon-pink');
                        indicator.querySelector('i').classList.remove('opacity-0');
                    }
                } else {
                    label.classList.remove('border-salon-pink');
                    if (indicator) {
                        indicator.classList.remove('bg-salon-pink');
                        indicator.querySelector('i').classList.add('opacity-0');
                    }
                }
                updateServiceValidation();
            });
        }
    });

    function updateServiceValidation() {
        let isAnyChecked = Array.from(serviceCheckboxes).some(cb => cb.checked);
        nextStep1Btn.disabled = !isAnyChecked;
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        serviceCheckboxes.forEach(cb => {
            if (cb.checked) {
                // Mengambil harga bersih dari data-price_raw
                const price = cb.dataset.price_raw;
                total += parseInt(price);
            }
        });
        // Menggunakan Intl.NumberFormat untuk format Rp
        totalPriceSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Step 2: Time Slot & Date Validation
    const timeSlots = document.querySelectorAll('.time-slot');
    const bookingDateInput = document.getElementById('booking_date');
    const bookingTimeInput = document.getElementById('booking_time');
    const nextStep2Btn = document.getElementById('next-step-2');

    timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                // Hapus selection dari semua slot
                timeSlots.forEach(s => s.classList.remove('selected'));
                // Tambahkan selection ke slot ini
                this.classList.add('selected');
                bookingTimeInput.value = this.dataset.time;
                checkStep2Validation();
            }
        });
    });

    bookingDateInput.addEventListener('change', checkStep2Validation);

    function checkStep2Validation() {
        const isDateSelected = bookingDateInput.value;
        const isTimeSelected = bookingTimeInput.value;
        nextStep2Btn.disabled = !(isDateSelected && isTimeSelected);
    }

    // Main Validation
    function validateStep(stepIndex) {
        if (stepIndex === 1) {
            return Array.from(serviceCheckboxes).some(cb => cb.checked);
        }
        if (stepIndex === 2) {
            return bookingDateInput.value && bookingTimeInput.value;
        }
        return true; // Step 3 hanya konfirmasi
    }

    // --- SUMMARY & WHATSAPP REDIRECT ---

    function updateSummary() {
        const form = document.getElementById('booking-form');
        const formData = new FormData(form);

        // 1. Layanan
        let selectedServices = [];
        let total = 0;
        document.querySelectorAll('input[name="selected_services"]:checked').forEach(cb => {
            selectedServices.push(cb.value);
            const price = cb.dataset.price_raw; // Ambil harga bersih
            total += parseInt(price);
        });

        document.getElementById('summary-services').textContent = selectedServices.join(', ');
        document.getElementById('summary-date').textContent = formData.get('booking_date');
        document.getElementById('summary-time').textContent = formData.get('booking_time');
        document.getElementById('summary-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function redirectToWhatsApp() {
        const form = document.getElementById('booking-form');

        // Memastikan Step 3 (data diri) valid
        if (!document.getElementById('name').value || !document.getElementById('phone').value) {
            alert('Mohon lengkapi semua data diri (Nama & Nomor WhatsApp) sebelum mengirim.');
            return;
        }

        // Ambil Data
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const date = document.getElementById('booking_date').value;
        const time = document.getElementById('booking_time').value;

        let services = [];
        document.querySelectorAll('input[name="selected_services"]:checked').forEach(cb => {
            services.push(cb.value);
        });
        const servicesString = services.join(', ');
        const totalPrice = document.getElementById('summary-price').textContent; // Sudah terformat

        // Susun Pesan WhatsApp
        // Menggunakan nomor telepon yang dimasukkan pelanggan jika berbeda dari nomor Anda,
        // namun tetap mengarah ke nomor WA Anda.
        const message = `Halo Elegance Salon,\n\nSaya ingin booking janji temu dengan detail berikut:\n\n*Nama:* ${name}\n*No. Telp Pelanggan:* ${phone}\n*Layanan:* ${servicesString}\n*Tanggal:* ${date}\n*Waktu:* ${time}\n\n*Estimasi Biaya:* ${totalPrice}\n\nMohon konfirmasi ketersediaan dan booking saya. Terima kasih.`;

        const encodedMessage = encodeURIComponent(message);
        const whatsappLink = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

        // Arahkan ke WhatsApp
        window.open(whatsappLink, '_blank');

        // Mencegah form submission
        return false;
    }

    // Inisialisasi
    updateStepDisplay();
</script>
@endpush
