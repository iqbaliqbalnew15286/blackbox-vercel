<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem; // 1. Model MenuItem (sudah ada)
use App\Models\PromoItem; // 2. Kita import Model PromoItem
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 3. Mengambil data menu (sudah ada)
        $menuItems = MenuItem::all();

        // 4. Mengambil data promo (sesuai catatan di promo-section.blade.php)
        //    Kita ambil promo yang aktif, belum kedaluwarsa, diurutkan, dan dibatasi 6.
        $promoItems = PromoItem::where('is_active', true)
            ->where('end_date', '>=', now())
            ->orderBy('end_date', 'asc')
            ->take(6) // Ambil 6 promo terbaru
            ->get();


        $testimonials = Testimonial::where('is_visible', true)
            ->latest()
            ->get();


        // 5. Mengirim kedua data ke view 'welcome'
        return view('welcome', [
            'menuItems' => $menuItems,
            'promoItems' => $promoItems, // Data promo ditambahkan di sini
            'testimonials' => $testimonials,
        ]);
    }

    public function menuPage() {}
}
