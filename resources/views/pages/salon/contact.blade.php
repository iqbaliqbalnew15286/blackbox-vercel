@extends('layouts.salon')

@section('title', 'Elegance Salon & Spa - Hubungi Kami')

{{-- Menambahkan Style khusus untuk halaman Contact --}}
@push('styles')
    <style>
        /* Mengganti nama variabel agar konsisten dengan layout */
        .text-dark-brownish-gray {
            color: var(--dark-accent);
        }
        .bg-dark-brownish-gray {
            background-color: var(--dark-accent);
        }
        .text-accent-pink {
            color: var(--salon-pink);
        }
        .bg-accent-pink {
            background-color: var(--salon-pink);
        }
        .focus\:ring-accent-pink:focus {
            --tw-ring-color: var(--salon-pink) !important;
        }
        .focus\:border-accent-pink:focus {
            border-color: var(--salon-pink) !important;
        }
    </style>
@endpush

@section('content')

{{-- Hero Section Kontak --}}
<section class="py-24 bg-accent-light text-center border-b-4 border-salon-pink/40">
    <div class="container mx-auto px-6 lg:px-12">
        <p class="text-xl font-medium text-salon-pink tracking-widest mb-3 uppercase">KAMI SIAP MEMBANTU</p>
        <h1 class="text-6xl font-elegant font-bold text-dark-accent mb-4">Hubungi Elegance</h1>
        <p class="text-lg text-dark-accent/80 max-w-3xl mx-auto">Untuk pertanyaan, pemesanan kelompok, atau masukan, silakan hubungi kami melalui salah satu saluran di bawah ini.</p>
    </div>
</section>

{{-- Kontak Detail dan Form --}}
<section class="py-20 bg-cream">
    <div class="container mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Kolom Kiri: Detail Kontak (Dark Accent Block) --}}
        <div class="lg:col-span-1 space-y-8 p-8 bg-dark-accent rounded-2xl shadow-2xl text-white transform transition duration-500 hover:scale-[1.01]">
            <h2 class="text-3xl font-elegant font-bold mb-6 border-b border-white/20 pb-4 text-salon-pink">Informasi Utama</h2>

            {{-- Alamat --}}
            <div class="flex items-start">
                <i class="fa-solid fa-map-marker-alt w-6 text-accent-light text-2xl mt-1"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-white">Alamat Kami</p>
                    <p class="text-gray-300">Jl. Anggrek No. 12, Jakarta Selatan, 12190</p>
                </div>
            </div>

            {{-- Telepon --}}
            <div class="flex items-start">
                <i class="fa-solid fa-phone w-6 text-accent-light text-2xl mt-1"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-white">Telepon & WhatsApp</p>
                    <p class="text-gray-300">0895-0266-9582 (WA Aktif)</p>
                </div>
            </div>

            {{-- Email --}}
            <div class="flex items-start">
                <i class="fa-solid fa-envelope w-6 text-accent-light text-2xl mt-1"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-white">Email Resmi</p>
                    <p class="text-gray-300">info@elegance.com</p>
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="pt-4 border-t border-white/20">
                <p class="text-lg font-semibold text-white mb-2">Jam Buka</p>
                <p class="text-sm text-gray-300">Senin - Jumat: <span class="font-medium text-salon-pink">10.00 - 20.00</span></p>
                <p class="text-sm text-gray-300">Sabtu: <span class="font-medium text-salon-pink">09.00 - 18.00</span></p>
                <p class="text-sm text-gray-300">Minggu: <span class="font-medium text-gray-400">Tutup (Khusus Janji)</span></p>
            </div>
        </div>

        {{-- Kolom Kanan: Formulir Kontak (WhatsApp Enabled) --}}
        <div class="lg:col-span-2 p-8 bg-white rounded-2xl shadow-2xl border-t-8 border-salon-pink">
            <h2 class="text-3xl font-elegant font-bold text-dark-accent mb-6">Kirim Pesan (Via WhatsApp)</h2>
            <p class="text-gray-600 mb-8">Isi detail di bawah, pesan Anda akan dialihkan ke WhatsApp kami secara otomatis.</p>

            <form id="contact-form" class="space-y-6">
                @csrf
                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-salon-pink focus:border-salon-pink transition">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email (Untuk Informasi Balasan)</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-salon-pink focus:border-salon-pink transition">
                </div>

                {{-- Subjek --}}
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subjek/Topik Pesan</label>
                    <input type="text" name="subject" id="subject" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-salon-pink focus:border-salon-pink transition">
                </div>

                {{-- Pesan --}}
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                    <textarea name="message" id="message" rows="5" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-salon-pink focus:border-salon-pink transition"></textarea>
                </div>

                {{-- Tombol Submit --}}
                <div>
                    {{-- Tombol yang akan memicu fungsi JavaScript --}}
                    <button type="button" onclick="sendWhatsApp()" class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-md text-xl font-bold rounded-full text-white bg-salon-pink hover:bg-dark-accent transition duration-300 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-salon-pink btn-booking">
                        <i class="fa-brands fa-whatsapp mr-3"></i> Kirim Pesan ke WhatsApp
                    </button>
                    <p class="text-xs text-center text-gray-400 mt-2">Pesan akan otomatis terisi di aplikasi WhatsApp Anda.</p>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Peta Lokasi (Opsional) --}}
<section class="container mx-auto px-6 lg:px-12 mb-20">
    <div class="h-96 rounded-2xl overflow-hidden shadow-2xl border-4 border-salon-pink/30">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.368812345678!2d106.8271700!3d-6.2087600!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNSJTIDEwNsKwNDknMzkuOCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            title="Lokasi Elegance Salon & Spa">
        </iframe>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        function sendWhatsApp() {
            // 1. Ambil nilai dari formulir
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // 2. Validasi sederhana
            if (!name || !email || !subject || !message) {
                alert('Semua kolom harus diisi sebelum mengirim pesan.');
                return;
            }

            // 3. Nomor WhatsApp tujuan
            const waNumber = '6289502669582';

            // 4. Format pesan untuk WhatsApp
            // Baris pertama sesuai permintaan: "*Pesan dari Website - Elegance Salon*"
            // %0A adalah kode untuk New Line (Baris Baru)
            const waMessage = `*Pesan dari Website - Elegance Salon*%0A%0A` +
                              `===========================%0A` +
                              `*Subjek:* ${encodeURIComponent(subject)}%0A` +
                              `*Nama Lengkap:* ${encodeURIComponent(name)}%0A` +
                              `*Email:* ${encodeURIComponent(email)}%0A` +
                              `===========================%0A` +
                              `*Pesan Anda:*%0A` +
                              `${encodeURIComponent(message)}`;

            // 5. Buat URL WhatsApp API
            const waURL = `https://wa.me/${waNumber}?text=${waMessage}`;

            // 6. Redirect pengguna
            window.open(waURL, '_blank');
        }

        // Tambahkan event listener untuk mencegah submit form default
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            sendWhatsApp();
        });
    </script>
@endpush
