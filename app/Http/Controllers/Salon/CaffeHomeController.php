<?php

namespace App\Http\Controllers\Caffe;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\PromoItem;
use App\Models\Testimonial;
use App\Models\OurTeam;
use App\Models\VideoItem;
use App\Models\Image; // Ditambahkan untuk Galeri

class CaffeHomeController extends \App\Http\Controllers\Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // --- DATA UNTUK HERO SECTION & SUBSEQUENT SECTIONS (Preview) ---

        // Mengambil menu favorit (misalnya, yang ditandai sebagai 'favorite')
        $favoriteMenu = MenuItem::where('is_favorite', true)
                                ->take(5)
                                ->get();

        // Mengambil menu makanan (untuk Quick List atau preview)
        $foodItems = MenuItem::where('category', 'Food')->take(4)->get();


        // Mengambil testimonial (3 terbaru)
        $testimonials = Testimonial::where('is_visible', true)
            ->latest()
            ->take(3)
            ->get();

        // Mengambil preview tim (3 orang)
        $ourteams = OurTeam::latest()->take(3)->get();

        // Mengambil preview galeri (4 gambar)
        // Asumsi Model Galeri/Image adalah App\Models\Image
        $galleryPreview = Image::latest()->take(4)->get();

        return view('caffe.public.welcome', [
            'favoriteMenu' => $favoriteMenu,
            'foodItems' => $foodItems,
            'testimonials' => $testimonials,
            'ourteams' => $ourteams,
            'galleryPreview' => $galleryPreview,
        ]);
    }

    public function menuPage()
    {
        // Mengambil data menu dengan kategori
        $foodItems = MenuItem::where('category', 'Food')->get();
        $drinkItems = MenuItem::where('category', 'Drinks')->get();
        $snackItems = MenuItem::where('category', 'Snacks')->get();

        return view('caffe.public.menu.index', [
            'foodItems' => $foodItems,
            'drinkItems' => $drinkItems,
            'snackItems' => $snackItems,
        ]);
    }

    public function aboutPage()
    {
        return view('caffe.public.about');
    }

    public function photosPage()
    {
        // Mengambil semua data gambar untuk halaman Gallery/Photos
        $images = Image::all();

        return view('caffe.public.photos.index', [
            'images' => $images,
        ]);
    }

    public function ourTeamPage()
    {
        // Mengambil semua data ourteam untuk halaman Our Team
        $ourteams = OurTeam::all();

        return view('caffe.public.about.ourteam', [
            'ourteams' => $ourteams,
        ]);
    }

    public function videosPage()
    {
        // Mengambil semua data video


       
    }
}
