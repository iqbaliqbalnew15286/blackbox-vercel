<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Menggunakan font Dosis untuk Judul agar lebih futuristik, Poppins untuk body */
        body { font-family: 'Poppins', sans-serif; }
        .font-title { font-family: 'Dosis', sans-serif; }

        /* Custom Fade-in Animation */
        .fade-card {
            opacity: 0;
            animation: fadeIn 1s ease forwards;
        }

        /* Delay untuk kartu kedua */
        .fade-card:nth-child(2) {
            animation-delay: 0.3s;
        }

        /* Delay untuk section Lokasi */
        .fade-location {
            opacity: 0;
            animation: fadeIn 1s ease forwards;
            animation-delay: 0.6s; /* Muncul setelah kartu */
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Neon Glow Effect (Menggantikan Shadow Standar) */
        .glow-pink {
            box-shadow: 0 0 15px rgba(236, 72, 153, 0.5), 0 0 30px rgba(236, 72, 153, 0.2);
        }

        .glow-cyan {
            box-shadow: 0 0 15px rgba(0, 204, 255, 0.5), 0 0 30px rgba(0, 204, 255, 0.2);
        }

        /* Hover Glow */
        .hover-glow-pink:hover {
            box-shadow: 0 0 25px rgba(236, 72, 153, 0.8), 0 0 50px rgba(236, 72, 153, 0.4);
        }

        .hover-glow-cyan:hover {
            box-shadow: 0 0 25px rgba(0, 204, 255, 0.8), 0 0 50px rgba(0, 204, 255, 0.4);
        }

        /* Hover Overlay Transparan */
        .card-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4));
        }
        .group:hover .card-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.3));
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-950 text-white">

    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">

        <h1 class="text-4xl md:text-6xl font-extrabold mb-16 tracking-tighter font-title text-center text-gray-50
                        drop-shadow-lg glow-cyan">
            PORTAL LAYANAN <span class="text-pink-500">UTAMA</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-6xl mb-16">

            {{-- 1. LINK SALON: Neon Pink Aesthetic --}}
            <a href="{{ url('/salon') }}"
                class="group relative rounded-3xl overflow-hidden bg-gray-900/40 backdrop-blur-md
                        border border-pink-600/50 glow-pink hover-glow-pink transition-all duration-500 transform hover:scale-[1.03]
                        fade-card">

                {{-- Gambar Latar Belakang --}}
                {{--

[Image of Elegance Salon logo icon]
 --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:opacity-60 transition-all duration-500"
                    style="background-image: url('{{ asset('assets/salon-bg.jpg') }}');"></div>

                {{-- Overlay dengan Gradasi --}}
                <div class="absolute inset-0 card-overlay transition-all duration-500"></div>

                <div class="relative p-14 flex flex-col items-center justify-center text-center space-y-6 h-full">
                    <i class="fas fa-spa text-6xl text-pink-500 mb-2 drop-shadow-xl"></i>
                    <h2 class="text-5xl font-extrabold tracking-tighter font-title text-white">Elegance Salon</h2>
                    <p class="text-gray-300 text-lg max-w-xs font-light">
                        Perawatan premium, sentuhan profesional, dan suasana mewah untuk transformasi terbaikmu.
                    </p>
                    <span class="mt-6 px-10 py-3 rounded-full bg-pink-600 text-white
                                     group-hover:bg-pink-700 group-hover:shadow-pink transition-all duration-300 font-bold text-base shadow-xl border border-white/20">
                        Masuk Salon <i class="fa-solid fa-arrow-right ml-2"></i>
                    </span>
                </div>
            </a>

            {{-- 2. LINK CAFFE: Neon Cyan/White Aesthetic --}}
            <a href="{{ url('/pages/caffe') }}"
                class="group relative rounded-3xl overflow-hidden bg-gray-900/40 backdrop-blur-md
                        border border-white/50 glow-cyan hover-glow-cyan transition-all duration-500 transform hover:scale-[1.03]
                        fade-card">

                {{-- Gambar Latar Belakang --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:opacity-60 transition-all duration-500"
                    style="background-image: url('{{ asset('assets/caffe-bg.jpg') }}');"></div>

                {{-- Overlay dengan Gradasi --}}
                <div class="absolute inset-0 card-overlay transition-all duration-500"></div>

                <div class="relative p-14 flex flex-col items-center justify-center text-center space-y-6 h-full">
                    <i class="fas fa-mug-hot text-6xl text-cyan-400 mb-2 drop-shadow-xl"></i>
                    <h2 class="text-5xl font-extrabold tracking-tighter font-title text-white">Caffe Black Box</h2>
                    <p class="text-gray-300 text-lg max-w-xs font-light">
                        Nikmati secangkir kopi terbaik dalam suasana yang gelap, modern, dan santai.
                    </p>
                    <span class="mt-6 px-10 py-3 rounded-full bg-white text-gray-900
                                     group-hover:bg-gray-200 group-hover:shadow-xl transition-all duration-300 font-bold text-base shadow-xl border border-cyan-400/50">
                        Masuk Kafe <i class="fa-solid fa-arrow-right ml-2"></i>
                    </span>
                </div>
            </a>

        </div>

        ---

        {{-- BAGIAN LOKASI KAMI --}}
        <div class="w-full max-w-6xl text-center fade-location mt-8">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4 tracking-tighter font-title text-cyan-400">
                <i class="fa-solid fa-location-dot mr-2"></i> Kunjungi Kami
            </h2>
            <p class="text-gray-300 text-lg mb-4 max-w-2xl mx-auto">
                Kami berlokasi di pusat kota, mudah dijangkau dari segala arah. Kami tunggu kehadiran Anda!
            </p>

            <div class="inline-block p-6 rounded-xl bg-gray-900/50 border border-gray-700/50 glow-cyan/50">
                <p class="text-xl font-medium text-white mb-4">
                    Jl. Jendral Sudirman No. 12A, RT.05/RW.02, Jakarta Pusat, 10220
                </p>

                {{-- Tombol Google Maps --}}
                <a href="https://maps.app.goo.gl/YourGoogleMapsLinkHere" target="_blank"
                    class="inline-flex items-center justify-center mt-3 px-8 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-base transition-all duration-300 transform hover:scale-[1.05]
                           border border-blue-400/50 glow-cyan hover-glow-cyan">
                    <i class="fa-solid fa-map-location-dot mr-2"></i> Lihat di Google Maps
                </a>
            </div>

        </div>

    </div>

</body>
</html>
