<?php

namespace App\Http\Controllers\Caffe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\OurTeam;
use App\Models\GalleryItem;
use App\Models\Testimonial; // 🎯 BARIS BARU: Import Model Testimonial

class CaffeHomeController extends Controller
{
    /**
     * Halaman utama caffe.
     */
    public function index()
    {
        $foodItems = MenuItem::where('category', 'Food')->get();
        $drinkItems = MenuItem::where('category', 'Drinks')->get();
        $snackItems = MenuItem::where('category', 'Snacks')->get();

        // Mengambil semua menu favorit/terbaru
        $favoriteMenu = MenuItem::latest()->get();

        // Ambil semua gambar dari CMS untuk preview di homepage
        $galleryPreview = GalleryItem::latest()->get();

        // Ambil data Our Team
        $ourteams = OurTeam::latest()->take(3)->get(); // Hanya ambil 3 untuk preview homepage

        // 🎯 BARIS BARU: Ambil semua data Testimonial
        $testimonials = Testimonial::latest()->get();

        return view('pages.caffe.caffe', compact(
            'foodItems',
            'drinkItems',
            'snackItems',
            'favoriteMenu',
            'galleryPreview',
            'ourteams',
            'testimonials' // 🎯 BARIS BARU: Lewatkan variabel testimonials ke view
        ));
    }

    /**
     * Halaman Menu Page
     */
    public function menuPage()
    {
        $foodItems = MenuItem::where('category', 'Food')->get();
        $drinkItems = MenuItem::where('category', 'Drinks')->get();
        $snackItems = MenuItem::where('category', 'Snacks')->get();

        return view('pages.caffe.menu', compact(
            'foodItems',
            'drinkItems',
            'snackItems'
        ));
    }

    /**
     * Halaman About / Our Story
     */
    public function aboutPage()
    {
        return view('pages.caffe.ourstory');
    }

    /**
     * Halaman Photos (sama seperti gallery public)
     */
    public function photosPage()
    {
        $images = GalleryItem::latest()->get();

        return view('pages.caffe.gallery', compact('images'));
    }

    /**
     * Halaman Our Team
     */
    public function ourTeamPage()
    {
        $ourteams = OurTeam::all();

        return view('pages.caffe.ourteam', compact('ourteams'));
    }

    /**
     * Halaman Videos
     */
    public function videosPage()
    {
        return view('pages.caffe.videos');
    }

    /**
     * Halaman Gallery utama
     */
    public function galleryPage()
    {
        $images = GalleryItem::latest()->get();

        return view('pages.caffe.gallery', compact('images'));
    }
}
