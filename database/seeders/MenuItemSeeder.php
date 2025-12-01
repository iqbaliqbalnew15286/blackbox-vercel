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
        // MenuItem::truncate(); // Commented out to avoid foreign key constraint issues

        // Sample menu item
        MenuItem::create([
            'name' => 'Kopi Hitam',
            'description' => 'Kopi hitam klasik yang kuat dan autentik',
            'price' => 15000,
            'category' => 'Drinks'
        ]);
    }
}
