<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LayananSalon;

class LayananSalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Facial Treatment',
                'description' => 'Perawatan wajah lengkap untuk kulit sehat dan bersinar',
                'photo' => 'layanan_photos/facial.jpg',
                'price' => 150000,
                'category' => 'facial',
                'is_visible' => true,
            ],
            [
                'name' => 'Hair Spa',
                'description' => 'Spa rambut untuk rambut sehat dan berkilau',
                'photo' => 'layanan_photos/hairspa.jpg',
                'price' => 100000,
                'category' => 'hair',
                'is_visible' => true,
            ],
            [
                'name' => 'Manicure & Pedicure',
                'description' => 'Perawatan kuku tangan dan kaki yang profesional',
                'photo' => 'layanan_photos/manicure.jpg',
                'price' => 80000,
                'category' => 'nails',
                'is_visible' => true,
            ],
        ];

        foreach ($services as $service) {
            LayananSalon::create($service);
        }
    }
}
