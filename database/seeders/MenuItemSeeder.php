<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem; // <-- Pastikan model MenuItem ada di App\Models

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat saat seeding ulang
        MenuItem::truncate();

        // === DARI GAMBAR 1 (PAKET GASKEUNN) ===
        // Kategori: Paket Gaskeunn
        MenuItem::create([
            'name' => 'Paket Amer',
            'description' => 'Ayam Merchon Ricebowl',
            'price' => 30000,
            'category' => 'Paket Gaskeunn'
        ]);

        MenuItem::create([
            'name' => 'Paket Bejo',
            'description' => 'Ayam Cabe Ijo',
            'price' => 30000,
            'category' => 'Paket Gaskeunn'
        ]);

        MenuItem::create([
            'name' => 'Paket Aki',
            'description' => 'Teriyaki Ricebowl',
            'price' => 30000,
            'category' => 'Paket Gaskeunn'
        ]);

        MenuItem::create([
            'name' => 'Paket Sistagor',
            'description' => 'Sosis Kentang Goreng',
            'price' => 25000,
            'category' => 'Paket Gaskeunn'
        ]);

        MenuItem::create([
            'name' => 'Paket Gultik',
            'description' => 'Gulai Tikungan',
            'price' => 20000,
            'category' => 'Paket Gaskeunn'
        ]);

        MenuItem::create([
            'name' => 'Paket Bcek',
            'description' => 'Roti Bakar Coklat Keju',
            'price' => 25000,
            'category' => 'Paket Gaskeunn'
        ]);


        // === DARI GAMBAR 2 (WARGHE MENU) ===
        // Kategori: Warmindo
        MenuItem::create([
            'name' => 'Indomie rebus soto',
            'description' => 'Indomie rebus soto',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        MenuItem::create([
            'name' => 'Indomie rebus kari ayam',
            'description' => 'Indomie rebus kari ayam',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        MenuItem::create([
            'name' => 'Indomie rebus Ayam Bawang',
            'description' => 'Indomie rebus Ayam Bawang',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        MenuItem::create([
            'name' => 'Indomie goreng original',
            'description' => 'Indomie goreng original',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        MenuItem::create([
            'name' => 'Indomie goreng rendang',
            'description' => 'Indomie goreng rendang',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        MenuItem::create([
            'name' => 'Indomie goreng Ayam Geprek',
            'description' => 'Indomie goreng Ayam Geprek',
            'price' => 8000,
            'category' => 'Warmindo'
        ]);

        // Kategori: Tea
        MenuItem::create([
            'name' => 'Original Tea',
            'description' => 'Original Tea',
            'price' => 8000,
            'category' => 'Tea'
        ]);

        MenuItem::create([
            'name' => 'Lychee Tea',
            'description' => 'Lychee Tea',
            'price' => 15000,
            'category' => 'Tea'
        ]);

        MenuItem::create([
            'name' => 'Lemon Tea',
            'description' => 'Lemon Tea',
            'price' => 15000,
            'category' => 'Tea'
        ]);

        MenuItem::create([
            'name' => 'Yakult Tea',
            'description' => 'Yakult Tea',
            'price' => 15000,
            'category' => 'Tea'
        ]);

        MenuItem::create([
            'name' => 'Milo Tea',
            'description' => 'Milo Tea',
            'price' => 15000,
            'category' => 'Tea'
        ]);

        MenuItem::create([
            'name' => 'Thai Tea',
            'description' => 'Thai Tea',
            'price' => 15000,
            'category' => 'Tea'
        ]);

        // Kategori: Milktea
        MenuItem::create([
            'name' => 'Original Milktea',
            'description' => 'Original Milktea',
            'price' => 15000,
            'category' => 'Milktea'
        ]);

        MenuItem::create([
            'name' => 'Choco Oreo Milktea',
            'description' => 'Choco Oreo Milktea',
            'price' => 15000,
            'category' => 'Milktea'
        ]);

        MenuItem::create([
            'name' => 'Green Tea Milktea',
            'description' => 'Green Tea Milktea',
            'price' => 15000,
            'category' => 'Milktea'
        ]);

        MenuItem::create([
            'name' => 'Red Velvet',
            'description' => 'Red Velvet Milktea',
            'price' => 15000,
            'category' => 'Milktea'
        ]);

        // Kategori: Additional
        MenuItem::create([
            'name' => 'Air Mineral',
            'description' => 'Air Mineral',
            'price' => 5000,
            'category' => 'Additional'
        ]);

        MenuItem::create([
            'name' => 'Nasi',
            'description' => 'Nasi Putih',
            'price' => 5000,
            'category' => 'Additional'
        ]);

        MenuItem::create([
            'name' => 'Es',
            'description' => 'Es Batu',
            'price' => 3000,
            'category' => 'Additional'
        ]);

        // Kategori: Topping
        MenuItem::create(['name' => 'Pedas Level 1', 'description' => 'Topping Pedas Level 1', 'price' => 1000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Pedas Level 2', 'description' => 'Topping Pedas Level 2', 'price' => 2000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Pedas Level 3', 'description' => 'Topping Pedas Level 3', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Keju Parut', 'description' => 'Topping Keju Parut', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Keju Slice', 'description' => 'Topping Keju Slice', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Kornet', 'description' => 'Topping Kornet', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Sosis', 'description' => 'Topping Sosis', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Bakso', 'description' => 'Topping Bakso', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Telur', 'description' => 'Topping Telur', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Dumpling Cheese', 'description' => 'Topping Dumpling Cheese', 'price' => 3000, 'category' => 'Topping']);
        MenuItem::create(['name' => 'Dumpling Ayam', 'description' => 'Topping Dumpling Ayam', 'price' => 3000, 'category' => 'Topping']);

        // Kategori: Coffee
        MenuItem::create(['name' => 'Kopi WARGHE HOT/ICE', 'description' => 'Kopi WARGHE HOT/ICE', 'price' => 15000, 'category' => 'Coffee']);
        MenuItem::create(['name' => 'Kopi Mocacinno HOT/ICE', 'description' => 'Kopi Mocacinno HOT/ICE', 'price' => 15000, 'category' => 'Coffee']);
        MenuItem::create(['name' => 'White Coffee HOT/ICE', 'description' => 'White Coffee HOT/ICE', 'price' => 15000, 'category' => 'Coffee']);
        MenuItem::create(['name' => 'Kopi pahit', 'description' => 'Kopi pahit', 'price' => 10000, 'category' => 'Coffee']);
        MenuItem::create(['name' => 'Kopi Liong', 'description' => 'Kopi Liong', 'price' => 10000, 'category' => 'Coffee']);

        // Kategori: Snack
        MenuItem::create(['name' => 'Dimsum (Isi 4)', 'description' => 'Dimsum (Isi 4)', 'price' => 20000, 'category' => 'Snack']);
        MenuItem::create(['name' => 'Kentang sosis goreng', 'description' => 'Kentang sosis goreng', 'price' => 23500, 'category' => 'Snack']);
        MenuItem::create(['name' => 'Roti Bakar Coklat Keju', 'description' => 'Roti Bakar Coklat Keju', 'price' => 23000, 'category' => 'Snack']);


        // === DARI GAMBAR 3 (SPECIAL GRAND PRIX) ===
        // Kategori: Special Grand Prix
        MenuItem::create([
            'name' => 'Baso Gasspol (Baso Special)',
            'description' => 'Terbuat dari daging pilihan dengan tekstur kenyal dan bumbu rempah khas. Disajikan dengan kuah kaldu hangat.',
            'price' => 25000,
            'category' => 'Special Grand Prix'
        ]);

        MenuItem::create([
            'name' => 'Mie Ayam Touring (Mie Ayam Original)',
            'description' => 'Sensasi mie kenyal berpadu sempurna dengan ayam berbumbu gurih yang meresap hingga ke setiap suapannya.',
            'price' => 22000,
            'category' => 'Special Grand Prix'
        ]);

        MenuItem::create([
            'name' => 'Mie Ayam Touring (Mie Ayam + Baso)',
            'description' => 'Mie Ayam Original ditambah dengan Baso. Sensasi mie kenyal berpadu sempurna dengan ayam berbumbu gurih.',
            'price' => 25000,
            'category' => 'Special Grand Prix'
        ]);

        MenuItem::create([
            'name' => 'Pangsit Owshit (Pangsit Chili Oil)',
            'description' => 'Terbuat dari daging pilihan dengan tekstur kenyal dan bumbu rempah khas. Disajikan dengan chili oil.',
            'price' => 22000,
            'category' => 'Special Grand Prix'
        ]);

        MenuItem::create([
            'name' => 'Pangsit Owshit (Pangsit Kuah)',
            'description' => 'Terbuat dari daging pilihan dengan tekstur kenyal dan bumbu rempah khas. Disajikan dengan kuah kaldu hangat.',
            'price' => 22000,
            'category' => 'Special Grand Prix'
        ]);
    }
}