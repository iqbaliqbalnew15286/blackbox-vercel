<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoItem; // 1. Import model PromoItem
use Carbon\Carbon; // 2. Import Carbon untuk manajemen tanggal

class PromoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        PromoItem::truncate();

        // Buat data promo baru
        PromoItem::create([
            'name' => 'Promo Merdeka 17%',
            'description' => 'Nikmati diskon 17% untuk semua menu minuman Kopi Series dalam rangka hari kemerdekaan.',
            'image' => null, // Ganti dengan path/nama file gambar jika ada, misal: 'promos/merdeka.jpg'
            'code' => 'MERDEKA17',
            'discount_type' => 'percentage', // Tipe diskon: 'percentage' or 'fixed'
            'discount_value' => 17, // Nilai 17%
            'start_date' => Carbon::now()->startOfMonth(), // Mulai dari awal bulan ini
            'end_date' => Carbon::now()->endOfMonth(), // Berakhir di akhir bulan ini
            'is_active' => true,
        ]);

        PromoItem::create([
            'name' => 'Potongan 10K Paket Gaskeunn',
            'description' => 'Dapatkan potongan harga Rp 10.000 untuk pembelian Paket Amer atau Paket Aki.',
            'image' => null, // Ganti dengan path/nama file gambar jika ada
            'code' => 'GaskeunnHEMAT',
            'discount_type' => 'fixed', // Tipe diskon: 'percentage' or 'fixed'
            'discount_value' => 10000, // Nilai Rp 10.000
            'start_date' => Carbon::now(), // Mulai dari hari ini
            'end_date' => Carbon::now()->addWeeks(2), // Berakhir 2 minggu dari sekarang
            'is_active' => true,
        ]);

        PromoItem::create([
            'name' => 'Promo Grand Opening (Kedaluwarsa)',
            'description' => 'Promo spesial grand opening yang sudah berakhir bulan lalu.',
            'image' => null,
            'code' => 'GRANDOPEN',
            'discount_type' => 'percentage',
            'discount_value' => 50,
            'start_date' => Carbon::now()->subMonth()->startOfMonth(), // Mulai bulan lalu
            'end_date' => Carbon::now()->subMonth()->endOfMonth(), // Berakhir bulan lalu
            'is_active' => false, // Sudah tidak aktif
        ]);

        PromoItem::create([
            'name' => 'Buy 1 Get 1 Kopi Warghe',
            'description' => 'Beli 1 Kopi Warghe (HOT/ICE) dapat gratis 1 lagi. Berlaku akhir pekan ini.',
            'image' => null,
            'code' => 'BOGOWARGHE',
            'discount_type' => 'fixed', // Anggap 'fixed' di sini berarti BOGO (implementasi logic di app)
            'discount_value' => 0, // Nilai bisa 0 atau harga produk
            'start_date' => Carbon::now()->next(Carbon::FRIDAY), // PERBAIKAN: Menggunakan next()
            'end_date' => Carbon::now()->next(Carbon::SUNDAY), // PERBAIKAN: Menggunakan next()
            'is_active' => true,
        ]);
    }
}