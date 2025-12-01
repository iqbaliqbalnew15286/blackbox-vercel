<?php

namespace App\Http\Controllers\Salon;

use Illuminate\Http\Request;
use App\Models\GallerySalon; // Model untuk Galeri
use App\Models\OurTeam;     // Model untuk Tim
use App\Models\LayananSalon; // Model untuk Layanan Salon
use App\Models\TestimonialSalon; // Model untuk Testimoni Salon
use App\Http\Controllers\Controller; // Pastikan menggunakan Controller base class

class SalonHomeController extends Controller
{
    /**
     * Menampilkan halaman Home Salon (Index).
     * Mengambil data yang dibutuhkan oleh views/pages/salon/salon.blade.php
     */
    public function index()
    {
        // Mengambil 3 item Layanan unggulan atau terbaru dari layanan_salon
        $featuredServices = LayananSalon::where('is_visible', true)->orderBy('id', 'asc')->take(3)->get();

        // Mengambil 2 testimoni terbaru untuk pratinjau di Home
        $testimonials = TestimonialSalon::latest()->take(2)->get();

        // Mengambil 3 anggota tim terbaru untuk pratinjau di Home
        $team = OurTeam::latest()->take(3)->get();

        // Mengambil 4 item galeri terbaru untuk pratinjau
        $galleryPreview = GallerySalon::latest()->take(4)->get();

        // Mengarahkan ke halaman utama salon
        return view('pages.salon.salon', compact('featuredServices', 'testimonials', 'team', 'galleryPreview'));
    }

    /**
     * Menampilkan halaman Layanan (Services).
     * Mengambil semua data layanan.
     */
    public function servicesPage()
    {
        // Ambil semua layanan salon yang visible, di-grouping berdasarkan kategori
        $services = LayananSalon::where('is_visible', true)->get()->groupBy('category');

        // View: resources/views/pages/salon/layanan.blade.php
        return view('pages.salon.layanan', compact('services'));
    }

    /**
     * Menampilkan halaman Galeri (Gallery).
     * Mengambil semua item galeri.
     */
    public function galleryPage()
    {
        // Ambil semua item galeri
        $images = GallerySalon::all();

        // View: resources/views/pages/salon/gallery.blade.php (sesuai file yang kita buat)
        return view('pages.salon.gallery', compact('images'));
    }

    /**
     * Menampilkan halaman Tim Kami (Our Team).
     * Mengambil semua anggota tim.
     */
    public function teamPage()
    {
        // Ambil semua anggota tim
        $ourteams = OurTeam::all();

        // View: resources/views/pages/salon/team.blade.php (sesuai file yang kita buat)
        return view('pages.salon.team', compact('ourteams'));
    }

    /**
     * Menampilkan halaman Kontak (Contact).
     */
    public function contactPage()
    {
        // View: resources/views/pages/salon/contact.blade.php (sesuai file yang kita buat)
        return view('pages.salon.contact');
    }

    /**
     * Menampilkan halaman Booking dengan data layanan dari database.
     */
    public function bookingPage()
    {
        // Ambil semua layanan salon yang visible untuk booking
        $services = LayananSalon::where('is_visible', true)->get();

        // View: resources/views/pages/salon/booking.blade.php
        return view('pages.salon.booking', compact('services'));
    }
}
