@extends('layouts.caffe')

@section('title', 'Blackbox - Our Story')

@section('content')

<section class="py-20 bg-black text-white min-h-screen">
    <div class="container mx-auto px-6 lg:px-12 max-w-6xl">

        {{-- HEADING --}}
        <h1 class="text-5xl md:text-7xl font-extrabold mb-4 text-center tracking-tight text-blue-400">
            <i class="fa-solid fa-sparkles mr-3"></i> Kisah Kami
        </h1>

        <p class="text-center text-gray-400 mb-16 max-w-4xl mx-auto text-xl">
            Dari mana kami berasal: **Kopi** yang kuat, dan **Komunitas** yang erat.
        </p>

        {{-- MAIN CONTENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">

            {{-- Left: Image & Quote --}}
            <div class="flex flex-col space-y-8">
                <div class="glass-card rounded-3xl overflow-hidden shadow-2xl border border-blue-600/20 transform hover:scale-[1.01] transition duration-500">
                    <img src="{{ asset('assets/owner.jpg') }}"
                        alt="Interior Blackbox Cafe"
                        class="w-full h-96 object-cover aspect-video opacity-90 hover:opacity-100 transition duration-500">
                </div>

                <blockquote class="p-6 bg-blue-900/40 rounded-xl border-l-4 border-blue-400 shadow-xl">
                    <p class="text-lg italic text-white/90">
                        "Setiap ide besar membutuhkan kafein yang hebat. Di Blackbox, kami menyediakan keduanya: kopi terbaik untuk memicu pikiran, dan ruang untuk membangun koneksi."
                    </p>
                    <footer class="mt-4 text-sm font-semibold text-blue-300">- Founder Blackbox</footer>
                </blockquote>
            </div>

            {{-- Right: Content (Glass Card Styled) --}}
            <div class="space-y-8 p-8 glass-card rounded-3xl shadow-2xl border border-white/10 flex flex-col justify-start">

                {{-- Section 1: Kopi Berkualitas --}}
                <div>
                    <h2 class="text-3xl font-bold text-blue-400 mb-3 border-b border-white/10 pb-2">
                        <i class="fa-solid fa-mug-saucer mr-2"></i> Dari Biji Hingga Cangkir
                    </h2>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Kisah kami berakar pada pengejaran **kesempurnaan rasa**. Kami hanya menggunakan biji kopi premium yang dipilih langsung dari petani lokal terbaik, dipanggang dengan presisi di *roastery* kami. Kami percaya, kualitas terbaik dimulai dari bahan baku. Setiap cangkir adalah hasil dari *passion* dan dedikasi.
                    </p>
                </div>

                {{-- Horizontal Rule for visual separation --}}
                <hr class="border-t border-blue-700/50">

                {{-- Section 2: Komunitas Otomotif --}}
                <div>
                    <h2 class="text-3xl font-bold text-blue-400 mb-3 border-b border-white/10 pb-2">
                        <i class="fa-solid fa-gauge-high mr-2"></i> Fueling The Community
                    </h2>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Blackbox bukan hanya kafe; ini adalah *hangout spot* resmi bagi para pecinta kecepatan dan mesin. Terinspirasi dari estetika **otomotif**—desain minimalis, fokus pada fungsi, dan *dark aesthetic*—kami menciptakan tempat di mana ide-ide komunitas beradu, di luar garasi dan di dalam kafe.
                    </p>
                </div>

                {{-- Horizontal Rule for visual separation --}}
                <hr class="border-t border-blue-700/50">

                {{-- Section 3: Visi Masa Depan --}}
                <div>
                    <h2 class="text-3xl font-bold text-blue-400 mb-3 border-b border-white/10 pb-2">
                        <i class="fa-solid fa-location-dot mr-2"></i> Visi Kami
                    </h2>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Kami berkomitmen untuk terus menjadi titik temu yang berkembang, menghadirkan menu yang **inovatif**, dan yang terpenting, menjaga suasana hangat yang menjadi ciri khas Blackbox. Terima kasih telah menjadi bagian dari kisah yang kami bangun bersama ini.
                    </p>
                </div>

                <div class="mt-8 text-white font-semibold pt-4 border-t border-blue-700/50">
                    <i class="fa-solid fa-map-pin mr-2 text-blue-400"></i> Kunjungi kami di Jl. Raya Otomotif No.123, Jakarta
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
