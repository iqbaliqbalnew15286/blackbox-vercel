<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GallerySalon;

class GallerySalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'name' => 'Interior Salon',
                'image_path' => 'gallery_salon_images/AtdmteVym0WsDj21Yj6sNRs7sftxFMVTZi8wTQNV.png',
                'description' => 'Interior salon yang elegan dan nyaman',
            ],
            [
                'name' => 'Treatment Room',
                'image_path' => 'gallery_salon_images/LDN1IE4hxZoJQhq2laa5aZPL29jRKdVQcaRn1bC7.png',
                'description' => 'Ruangan treatment dengan fasilitas lengkap',
            ],
            [
                'name' => 'Spa Area',
                'image_path' => 'gallery_salon_images/wotRTFUbZ3MtT1UJDRd2cJ3CnLd4QogK4dHC1DFA.png',
                'description' => 'Area spa yang relaksasi',
            ],
        ];

        foreach ($images as $image) {
            GallerySalon::create($image);
        }
    }
}
