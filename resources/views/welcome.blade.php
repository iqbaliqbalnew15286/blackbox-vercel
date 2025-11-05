@extends('layouts.public-app')

@section('')

@section('content')

  <section id="hero"
    class="relative bg-cover bg-center bg-no-repeat text-[var(--cafe-dark-blue)] min-h-[90vh] md:min-h-screen flex items-center"
    style="background-image: url('{{ asset('assets/bgwarghe.jpg') }}'); margin-top: -90px;">
    <style>
      :root {
        --cafe-dark-blue: #0b1c3f;

        /* Variabel coklat ini tidak kita pakai lagi, tapi bisa dibiarkan saja */
        --cafe-accent-brown: #704010;

        --cafe-light-gray: #d9d9d9;
        --cafe-link-active-text: #0b1c3f;
      }

      body {
        font-family: 'Poppins', sans-serif;
      }

      /* --- PERUBAHAN DI SINI --- */
      .btn-primary {
        background: var(--cafe-dark-blue);
        /* Diubah dari --cafe-accent-brown */
        color: #fff;
        font-weight: 500;
        border-radius: 10px;
        transition: all .3s ease;
      }

      .btn-primary:hover {
        background: #102a5c;
        /* Diubah dari #8b541a (hover biru yg lebih cerah) */
        transform: translateY(-3px);
      }

      .btn-outline {
        border: 2px solid var(--cafe-dark-blue);
        /* Diubah dari --cafe-accent-brown */
        color: var(--cafe-dark-blue);
        /* Diubah dari --cafe-accent-brown */
        font-weight: 500;
        border-radius: 10px;
        transition: all .3s ease;
      }

      .btn-outline:hover {
        background: var(--cafe-dark-blue);
        /* Diubah dari --cafe-accent-brown */
        color: #fff;
        transform: translateY(-3px);
      }

      /* --- AKHIR PERUBAHAN CSS --- */


      .animate-fade-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.8s ease forwards;
      }

      @keyframes fadeUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Sedikit bayangan halus agar teks tetap terbaca */
      .text-readable {
        text-shadow: 0 1px 3px rgba(255, 255, 255, 0.7);
      }
    </style>

    <div class="relative w-full max-w-7xl mx-auto px-6 sm:px-12 lg:px-24 xl:px-32 py-24 md:py-32 z-10">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 animate-fade-up text-readable text-center md:text-left">
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-tight">

            Nikmati Kopi Terbaik di <span class="text-[var(--cafe-dark-blue)]">Warung Garage House</span>

          </h1>

          <p class="text-lg text-[var(--cafe-dark-blue)] max-w-lg mx-auto md:mx-0">
            Rasakan suasana santai bergaya <em>garage and motorcycle</em>, di mana setiap tegukan kopi bercerita tentang
            rasa, aroma, dan kenangan.
          </p>

          <div class="flex items-center space-x-3 text-yellow-400 text-sm justify-center md:justify-start">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star-half-stroke"></i>
            <span class="text-[var(--cafe-dark-blue)] ml-2 font-medium">4.8/5 dari 6k+ ulasan</span>
          </div>

          <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center md:justify-start">
            <a href="#" class="btn-primary px-8 py-3 inline-flex items-center justify-center text-[15px]">
              <i class="fa-solid fa-mug-hot mr-2"></i> Pesan Sekarang
            </a>
            <a href="#" class="btn-outline px-8 py-3 inline-flex items-center justify-center text-[15px]">
              <i class="fa-solid fa-location-dot mr-2"></i> Kunjungi Kami
            </a>
          </div>
        </div>

        <div class="flex justify-center md:justify-end animate-float">

          <div
            class="relative w-72 h-72 sm:w-80 sm:h-80 md:w-[420px] md:h-[420px] rounded-full overflow-hidden ring-4 ring-[var(--cafe-dark-blue)]">
            <img src="{{ asset('assets/view.jpg') }}" alt="Coffee Cup" class="w-full h-full object-cover">
          </div>

        </div>

      </div>
    </div>
  </section>



  <section id="menu-slider" class="bg-[#0b1c3f] text-white py-12 overflow-hidden">
    <style>
      /* Animasi scroller tetap sama */
      @keyframes scroll {
        0% {
          transform: translateX(0);
        }

        100% {
          transform: translateX(-50%);
        }
      }

      .animate-scroll {
        animation-name: scroll;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
      }

      .scroller-track {
        display: flex;
        width: max-content;
        will-change: transform;
      }

      /* Pause animasi saat hover track (opsional, bisa dihapus jika ingin jalan terus) */
      .scroller-track:hover {
        animation-play-state: paused;
      }

      .scroller-mask {
        position: relative;
      }

      /* Masking gradient di kiri kanan */
      .scroller-mask::before,
      .scroller-mask::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 60px;
        /* Sedikit diperkecil agar lebih halus di mobile */
        z-index: 2;
        pointer-events: none;
        /* Agar tidak mengganggu interaksi mouse jika ada */
      }

      .scroller-mask::before {
        left: 0;
        background: linear-gradient(to right, #0b1c3f, transparent);
      }

      .scroller-mask::after {
        right: 0;
        background: linear-gradient(to left, #0b1c3f, transparent);
      }

      /* Style Kartu Menu yang Lebih Clean */
      .menu-card {
        transition: all 0.3s ease;
        /* Transisi lebih halus untuk semua properti */
        border: 1px solid #e5e7eb;
        /* Border lebih terang agar clean (gray-200) */
        /* Shadow awal yang sangat tipis */
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
      }

      /* Efek hover yang lebih subtle/tidak lebay */
      .menu-card:hover {
        transform: translateY(-5px);
        /* Naik sedikit saja, sebelumnya -10px */
        border-color: #d1d5db;
        /* Gray-300 saat hover */
        /* Shadow hover yang lebih soft dan terarah */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      }
    </style>

    <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-8">
      <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
          <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white">OUR MENU</h2>
          <p class="mt-2 text-lg text-gray-300">Ride By Passion Fueled By Warghe</p>
        </div>

        <a href="/menu"
          class="flex-shrink-0 bg-white text-[#0b1c3f] px-6 py-3 rounded-lg font-semibold text-base inline-flex items-center justify-center gap-2 transform transition-all duration-300 ease-out hover:scale-[1.02] hover:bg-gray-100 hover:shadow-md active:scale-95">
          <span>Lihat Semua Menu</span><i class="fa-regular fa-arrow-up-right-from-square"></i>
        </a>
      </div>
    </div>

    @isset($menuItems)
      <div class="scroller-mask mt-16">

        @php
          // Pengaturan durasi animasi
          $detik_per_item = 5;
          $total_items = $menuItems->count();
          $durasi_minimum = 40;
          $durasi_animasi = max($durasi_minimum, $total_items * $detik_per_item);
        @endphp

        <div class="scroller-track animate-scroll" style="animation-duration: {{ $durasi_animasi }}s;">

          {{-- SET 1: Item Asli --}}
          @foreach($menuItems as $item)
            <div class="flex-none px-4">
              <div class="block w-56 sm:w-64 md:w-72 menu-card rounded-xl overflow-hidden bg-white cursor-default">

                <div class="aspect-square relative bg-gray-100">
                  @php
                    $imageSrc = $item->photo
                      ? asset(str_starts_with($item->photo, 'storage/') ? $item->photo : 'storage/' . $item->photo)
                      : 'https://placehold.co/400x400/f3f4f6/6b7280?text=' . urlencode($item->name);
                  @endphp
                  <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="w-full h-full object-cover" loading="lazy" />
                </div>

                <div class="p-5 text-gray-900">
                  <span
                    class="inline-block bg-blue-50 text-[#0b1c3f] text-xs font-bold px-2.5 py-1 rounded-md mb-3 uppercase tracking-wider">
                    {{ $item->category }}
                  </span>
                  <h3 class="text-lg font-bold text-[#0b1c3f] line-clamp-1" title="{{ $item->name }}">
                    {{ $item->name }}
                  </h3>
                  <p class="text-base font-semibold text-gray-600 mt-1">
                    Rp{{ number_format($item->price ?? 0, 0, ',', '.') }}
                  </p>
                </div>

              </div>
            </div>
          @endforeach

          {{-- SET 2: Duplikat untuk looping --}}
          @foreach($menuItems as $item)
            <div class="flex-none px-4" aria-hidden="true">
              <div class="block w-56 sm:w-64 md:w-72 menu-card rounded-xl overflow-hidden bg-white cursor-default">

                <div class="aspect-square relative bg-gray-100">
                  @php
                    $imageSrc = $item->photo
                      ? asset(str_starts_with($item->photo, 'storage/') ? $item->photo : 'storage/' . $item->photo)
                      : 'https://placehold.co/400x400/f3f4f6/6b7280?text=' . urlencode($item->name);
                  @endphp
                  <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="w-full h-full object-cover" loading="lazy" />
                </div>

                <div class="p-5 text-gray-900">
                  <span
                    class="inline-block bg-blue-50 text-[#0b1c3f] text-xs font-bold px-2.5 py-1 rounded-md mb-3 uppercase tracking-wider">
                    {{ $item->category }}
                  </span>
                  <h3 class="text-lg font-bold text-[#0b1c3f] line-clamp-1" title="{{ $item->name }}">
                    {{ $item->name }}
                  </h3>
                  <p class="text-base font-semibold text-gray-600 mt-1">
                    Rp{{ number_format($item->price ?? 0, 0, ',', '.') }}
                  </p>
                </div>

              </div>
            </div>
          @endforeach

        </div>
      </div>
    @endisset
  </section>


  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <style>
    /* Kustomisasi MINIMAL untuk Navigasi Swiper */
    .promo-swiper-container .swiper-button-prev,
    .promo-swiper-container .swiper-button-next {
      color: #0a1a3c;
      /* Hanya mengubah warna panah agar sesuai tema */
      /* Ukuran dan bentuk dibiarkan default bawaan Swiper */
    }

    /* Opsional: Sedikit memperjelas saat di-hover, bisa dihapus jika ingin benar-benar basic */
    .promo-swiper-container .swiper-button-prev:hover,
    .promo-swiper-container .swiper-button-next:hover {
      color: #132b61;
    }

    /* Sembunyikan panah di mobile agar tidak menutupi konten (praktik standar) */
    @media (max-width: 639px) {

      .promo-swiper-container .swiper-button-prev,
      .promo-swiper-container .swiper-button-next {
        display: none;
      }
    }

    /* Styling Pagination Standar dengan warna tema */
    .promo-swiper .swiper-pagination-bullet-active {
      background-color: #0a1a3c;
    }
  </style>

  <section id="promo" class="bg-gray-50 py-12 sm:py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

      <div class="text-center mb-8 sm:mb-12">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[#0a1a3c] tracking-tight">PROMO SPESIAL</h2>
        <p class="mt-3 text-base sm:text-lg text-gray-500 max-w-2xl mx-auto">
          Temukan berbagai penawaran menarik dan berita terbaru khusus untukmu.
        </p>
      </div>

      @isset($promoItems)
        @if ($promoItems->count() > 0)
          <div class="relative promo-swiper-container">

            <div class="swiper-container promo-swiper !px-1 !py-6">
              <div class="swiper-wrapper items-stretch">
                @foreach ($promoItems as $promo)
                  <div class="swiper-slide !h-auto">
                    <div
                      class="group bg-white rounded-2xl shadow-sm hover:shadow-md flex flex-col h-full border border-gray-100 overflow-hidden transition-all duration-300">

                      @php
                        $imageSrc = $promo->image
                          ? asset(str_starts_with($promo->image, 'storage/') ? $promo->image : 'storage/' . $promo->image)
                          : 'https://placehold.co/600x400/e2e8f0/374151?text=' . urlencode($promo->name);
                      @endphp

                      <div class="relative h-48 sm:h-56 overflow-hidden">
                        <img src="{{ $imageSrc }}" alt="{{ $promo->name }}"
                          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-3 right-3">
                          <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $promo->discount_type == 'percentage' ? 'Diskon ' . (int) $promo->discount_value . '%' : 'Hemat Rp' . number_format($promo->discount_value, 0, ',', '.') }}
                          </span>
                        </div>
                      </div>

                      <div class="p-5 flex flex-col flex-grow">
                        <div class="mb-3">
                          <h3 class="text-lg font-bold text-[#0a1a3c] line-clamp-1" title="{{ $promo->name }}">
                            {{ $promo->name }}
                          </h3>
                          @if ($promo->end_date)
                            <p class="text-sm text-amber-600 mt-1">
                              <i class="fa-regular fa-clock mr-1"></i>
                              Berakhir: {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                            </p>
                          @endif
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4 flex-grow">
                          {{ $promo->description }}
                        </p>

                        @if ($promo->code)
                          <div class="mt-auto pt-4 border-t border-dashed border-gray-200">
                            <div class="flex items-center justify-between bg-gray-50 p-2.5 rounded-lg border border-gray-200">
                              <div class="text-[#0a1a3c] font-mono font-bold text-sm tracking-wider">{{ $promo->code }}</div>
                              <button
                                onclick="navigator.clipboard.writeText('{{ $promo->code }}'); alert('Kode berhasil disalin!')"
                                class="text-gray-500 hover:text-[#0a1a3c] transition-colors p-1" title="Salin Kode">
                                <i class="fa-regular fa-copy"></i>
                              </button>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="swiper-pagination !bottom-0"></div>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

          </div>
        @else
          <div class="text-center py-12 px-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <i class="fa-solid fa-ticket-simple text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900">Belum ada promo aktif</h3>
            <p class="text-gray-500 mt-1">Nantikan penawaran menarik dari kami segera!</p>
          </div>
        @endif
      @endisset

      <div class="text-center mt-10">
        <a href="/promo" class="inline-flex items-center gap-2 text-[#0a1a3c] font-semibold hover:underline">
          <span>Lihat Semua Promo</span>
          <i class="fa-regular fa-arrow-up-right-from-square"></i>
        </a>
      </div>

    </div>
  </section>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      new Swiper('.promo-swiper', {
        loop: false,
        spaceBetween: 20,
        slidesPerView: 1.2, // Mobile: sedikit terlihat slide sebelah
        centeredSlides: true,
        watchOverflow: true,
        grabCursor: true,
        breakpoints: {
          640: { slidesPerView: 2, centeredSlides: false, spaceBetween: 20 },
          1024: { slidesPerView: 3, centeredSlides: false, spaceBetween: 30 }
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    });
  </script>




<style>
  /* --- Container Slider --- */
  .testimonial-slider-container {
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 0 30px; /* Mobile */
  }

  @media (min-width: 640px) {
    .testimonial-slider-container { padding: 0 50px; }
  }
  @media (min-width: 1024px) {
    /* Memberi ruang lebih lega di desktop untuk panah yang lebih besar */
    .testimonial-slider-container { padding: 0 80px; }
  }

  /* --- Navigasi Panah Professional --- */
  .testimonial-nav-prev,
  .testimonial-nav-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 40px; height: 40px; /* Default Mobile */
    background-color: white;
    border: 1px solid #f3f4f6; /* Border lebih halus */
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #0a1a3c;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* Shadow lebih elegan */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* Desktop: Panah lebih besar dan tegas */
  @media (min-width: 1024px) {
      .testimonial-nav-prev, .testimonial-nav-next {
          width: 56px; height: 56px;
          font-size: 20px;
          background-color: #fff;
          box-shadow: 0 8px 24px rgba(0,0,0,0.12);
          border: none; /* Hapus border di desktop agar lebih clean */
      }
  }

  .testimonial-nav-prev:hover, .testimonial-nav-next:hover {
    background-color: #0a1a3c; color: white;
    transform: translateY(-50%) scale(1.05); /* Efek hover sedikit membesar */
    box-shadow: 0 12px 32px rgba(10, 26, 60, 0.25);
  }
  .testimonial-nav-prev.swiper-button-disabled, .testimonial-nav-next.swiper-button-disabled {
    opacity: 0; cursor: not-allowed; pointer-events: none; /* Hilang total jika disabled agar bersih */
  }

  .testimonial-nav-prev { left: 0; }
  .testimonial-nav-next { right: 0; }

  /* --- Pagination Styles --- */
  .testimonial-swiper .swiper-pagination-bullet {
    width: 8px; height: 8px; background-color: #cbd5e1; opacity: 1; transition: all 0.3s ease;
  }
  .testimonial-swiper .swiper-pagination-bullet-active {
    background-color: #0a1a3c; width: 24px; border-radius: 10px;
  }

  /* --- Dekorasi Tambahan: Ikon Kutipan Background --- */
  .quote-bg-icon {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      font-size: 4rem;
      color: #f1f5f9; /* Sangat samar (gray-100) */
      z-index: 0;
      pointer-events: none;
      font-family: serif; /* Font serif untuk kutipan agar klasik */
      line-height: 1;
  }
</style>

<section id="testimonials" class="bg-gray-50 py-20 sm:py-28 overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center max-w-3xl mx-auto mb-16">
      <h2 class="text-3xl md:text-4xl font-extrabold text-[#0a1a3c] tracking-tight">
        WHAT THEY SAY
      </h2>
      <div class="w-20 h-1 bg-[#0a1a3c] mx-auto my-4 rounded-full"></div> <p class="text-lg text-gray-600 leading-relaxed">
        Dengarkan pengalaman langsung dari mereka yang telah merasakan layanan kami.
      </p>
    </div>

    @isset($testimonials)
      @if ($testimonials->count() > 0)

        <div class="testimonial-slider-container">
          <div class="testimonial-nav-prev"><i class="fa-solid fa-chevron-left"></i></div>
          <div class="testimonial-nav-next"><i class="fa-solid fa-chevron-right"></i></div>

          <div class="swiper-container testimonial-swiper !py-10 !-my-10"> <div class="swiper-wrapper items-stretch"> @foreach ($testimonials as $testimonial)
                <div class="swiper-slide !h-auto px-3">
                  
                  <div class="group relative bg-white rounded-2xl p-8 h-full flex flex-col transition-all duration-300
                              shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)]
                              border border-transparent hover:border-blue-100">
                    
                    <div class="quote-bg-icon">“</div>

                    <div class="relative z-10 flex items-center gap-4 mb-6">
                      @php
                        $avatarSrc = $testimonial->avatar ? asset(str_starts_with($testimonial->avatar, 'storage/') ? $testimonial->avatar : 'storage/' . $testimonial->avatar) : 'https://placehold.co/100x100/e2e8f0/374151?text=' . substr($testimonial->name, 0, 1);
                      @endphp
                      <img src="{{ $avatarSrc }}" alt="{{ $testimonial->name }}" 
                           class="w-16 h-16 rounded-full object-cover border-4 border-gray-50 shadow-sm">
                      <div>
                        <h4 class="font-bold text-lg text-[#0a1a3c] leading-tight">{{ $testimonial->name }}</h4>
                        @if ($testimonial->role) 
                          <p class="text-sm font-medium text-gray-500 mt-1">{{ $testimonial->role }}</p> 
                        @endif
                      </div>
                    </div>

                    <div class="relative z-10 flex text-amber-400 mb-5 text-sm">
                      @for ($i = 0; $i < 5; $i++)
                        <i class="{{ $i < $testimonial->rating ? 'fa-solid' : 'fa-regular text-gray-300' }} fa-star mr-1"></i>
                      @endfor
                    </div>

                    <p class="relative z-10 text-gray-700 italic leading-relaxed flex-grow">
                      "{{ $testimonial->quote }}"
                    </p>
                  </div>
                  </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="text-center mt-12">
          <div class="swiper-pagination !relative !bottom-0 inline-block"></div>
        </div>

      @else
        <div class="text-center py-16 px-6 bg-white rounded-3xl border-2 border-dashed border-gray-200 max-w-lg mx-auto">
          <i class="fa-regular fa-comments text-5xl text-gray-300 mb-6"></i>
          <h3 class="text-xl font-bold text-gray-900">Belum Ada Ulasan</h3>
          <p class="text-gray-500 mt-2">Jadilah yang pertama memberikan masukan berharga Anda!</p>
        </div>
      @endif
    @endisset

    <div class="text-center mt-16">
      <a href="/testimonials" 
         class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white text-[#0a1a3c] font-semibold 
                border border-gray-200 shadow-sm hover:shadow-md hover:text-blue-800 hover:border-blue-100 transition-all">
        <span>Lihat Semua Testimoni</span> 
        <i class="fa-solid fa-arrow-right text-sm"></i>
      </a>
    </div>

  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper !== 'undefined') {
      new Swiper('.testimonial-swiper', {
        autoplay: { delay: 6000, disableOnInteraction: false, pauseOnMouseEnter: true },
        spaceBetween: 0, // Kita atur spacing via padding px-3 di slide agar shadow aman
        slidesPerView: 1,
        watchOverflow: true, // Sembunyikan navigasi jika slide sedikit
        breakpoints: {
          640: { slidesPerView: 1 },
          768: { slidesPerView: 2 },
          1024: { slidesPerView: 3 } // Desktop 3 kolom
        },
        pagination: { el: '.swiper-pagination', clickable: true, dynamicBullets: true },
        navigation: { nextEl: '.testimonial-nav-next', prevEl: '.testimonial-nav-prev' },
      });
    }
  });
</script>

  <section class="bg-[#0a1a3c] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        <!-- Kolom Kiri: Teks -->
        <div class="text-white">
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight mb-6">
            Crafted With Passion,<br>
            Brewed By Precision.
          </h2>

          <div class="space-y-4 text-gray-300 text-base sm:text-lg leading-relaxed">
            <p>
              Saat datang ke warghe saya sangat merasakan perbedaan cafe warghe, dimana dia mempunyai ciri khas unik
              dengan tema bikers dan motor yang menarik.
            </p>
            <p>
              Saat datang ke warghe saya sangat merasakan perbedaan cafe warghe, dimana dia mempunyai ciri khas unik
              dengan tema bikers dan motor yang menarik.
            </p>
          </div>

          <!-- Bagian Ikon Media Sosial yang Dimodifikasi -->
          <div class="flex items-center gap-4 mt-8">

            <!-- Instagram -->
            <a href="https://instagram.com/username" target="_blank" rel="noopener noreferrer" title="Instagram" class="w-12 h-12 bg-white rounded-full flex items-center justify-center transition-all duration-300
                        text-[#0a1a3c] hover:bg-gray-200 hover:scale-110 hover:shadow-lg">
              <!-- Gunakan text-xl atau text-2xl untuk ukuran ikon -->
              <i class="fa-brands fa-instagram text-2xl"></i>
            </a>

            <!-- TikTok -->
            <a href="https://tiktok.com/@username" target="_blank" rel="noopener noreferrer" title="TikTok" class="w-12 h-12 bg-white rounded-full flex items-center justify-center transition-all duration-300
                        text-[#0a1a3c] hover:bg-gray-200 hover:scale-110 hover:shadow-lg">
              <i class="fa-brands fa-tiktok text-xl"></i>
            </a>

            <!-- Facebook -->
            <a href="https://facebook.com/username" target="_blank" rel="noopener noreferrer" title="Facebook" class="w-12 h-12 bg-white rounded-full flex items-center justify-center transition-all duration-300
                        text-[#0a1a3c] hover:bg-gray-200 hover:scale-110 hover:shadow-lg">
              <i class="fa-brands fa-facebook-f text-xl"></i>
            </a>

            <!-- Opsional: WhatsApp -->
            <a href="https://wa.me/628123456789" target="_blank" rel="noopener noreferrer" title="WhatsApp" class="w-12 h-12 bg-white rounded-full flex items-center justify-center transition-all duration-300
                        text-[#0a1a3c] hover:bg-gray-200 hover:scale-110 hover:shadow-lg">
              <i class="fa-brands fa-whatsapp text-2xl"></i>
            </a>

          </div>

          <!-- Tombol "Lihat Tentang Warghe" -->
          <div class="mt-10">
            <a href="/about"
              class="inline-block bg-white text-[#0a1a3c] px-8 py-4 rounded-lg font-bold text-base tracking-wide transition-all hover:bg-gray-100 hover:shadow-lg hover:-translate-y-1 active:scale-95">
              Lihat Tentang Warghe
            </a>
          </div>
        </div>

        <!-- Kolom Kanan: Gambar Placeholder -->
        <div class="relative">
          <div class="w-full aspect-square bg-gray-300 rounded-xl shadow-2xl overflow-hidden">
            <!-- <img src="..." alt="Tentang Warghe" class="w-full h-full object-cover"> -->
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-8">

        <div class="flex items-center justify-between sm:justify-start sm:gap-6 p-4">
          <div class="text-left sm:text-right sm:flex-grow sm:order-1 lg:text-left lg:order-none lg:flex-grow-0">
            <h3 class="text-xl font-extrabold text-gray-900">Founder</h3>
            <p class="text-sm text-gray-500 mt-1">Muhamad Fulan</p>
          </div>
          <div class="flex-shrink-0 ml-4 sm:ml-0 sm:order-2 lg:ml-6">
            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-200 rounded-full overflow-hidden shadow-sm">
              <img src="https://placehold.co/400x400/e2e8f0/1f2937?text=Founder" alt="Founder"
                class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between sm:justify-start sm:gap-6 p-4">
          <div class="text-left sm:text-right sm:flex-grow sm:order-1 lg:text-left lg:order-none lg:flex-grow-0">
            <h3 class="text-xl font-extrabold text-gray-900">Co-Founder</h3>
            <p class="text-sm text-gray-500 mt-1">Muhamad Fulan</p>
          </div>
          <div class="flex-shrink-0 ml-4 sm:ml-0 sm:order-2 lg:ml-6">
            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-200 rounded-full overflow-hidden shadow-sm">
              <img src="https://placehold.co/400x400/e2e8f0/1f2937?text=Co-Founder" alt="Co-Founder"
                class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between sm:justify-center sm:gap-6 p-4 sm:col-span-2 lg:col-span-1">
          <div class="flex items-center w-full sm:w-auto justify-between sm:justify-start sm:gap-6">
            <div class="text-left sm:text-right sm:flex-grow sm:order-1 lg:text-left lg:order-none lg:flex-grow-0">
              <h3 class="text-xl font-extrabold text-gray-900">CEO</h3>
              <p class="text-sm text-gray-500 mt-1">Muhamad Fulan</p>
            </div>
            <div class="flex-shrink-0 ml-4 sm:ml-0 sm:order-2 lg:ml-6">
              <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-200 rounded-full overflow-hidden shadow-sm">
                <img src="{{ asset('assets/view.jpg') }}" alt="CEO" class="w-full h-full object-cover">
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="mt-16 sm:mt-24 w-full">
      <img src="{{ asset('assets/view.jpg') }}" alt="Cafe Interior"
        class="w-full h-96 object-cover md:h-[600px] lg:h-[700px]">
    </div>
  </section>
@endsection