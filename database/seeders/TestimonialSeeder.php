<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan tabel testimonials kosong dulu agar tidak duplikat saat seeding ulang (opsional)
        // DB::table('testimonials')->truncate(); 

        $testimonials = [
            [
                'name'       => 'Dinda Amelia Sari',
                'quote'      => 'Saat datang ke warghe saya sangat merasakan perbedaan cafe warghe, dimana dia mempunyai ciri khas unik dengan tema bikers dan motor yang menarik',
                'avatar'     => null, // Biarkan null agar memakai placeholder inisial
                'role'       => 'Mahasiswi',
                'rating'     => 5,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Budi Santoso',
                'quote'      => 'Kopinya enak banget, suasananya juga cozy buat ngerjain tugas atau sekedar nongkrong bareng temen-temen komunitas motor.',
                'avatar'     => null, 
                'role'       => 'Freelancer',
                'rating'     => 4,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}