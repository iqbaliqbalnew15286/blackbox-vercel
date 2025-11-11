<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = [
            // Makanan
            [
                'nama_produk' => 'Nasi Goreng',
                'deskripsi' => 'Nasi goreng spesial dengan telur dan ayam',
                'harga' => 15000,
                'kategori' => 'Makanan',
                'varian' => [
                    ['nama' => 'Pedas', 'harga_tambah' => 2000],
                    ['nama' => 'Extra Ayam', 'harga_tambah' => 5000]
                ]
            ],
            [
                'nama_produk' => 'Ayam Bakar',
                'deskripsi' => 'Ayam bakar dengan bumbu khas',
                'harga' => 20000,
                'kategori' => 'Makanan',
                'varian' => [
                    ['nama' => 'Pedas', 'harga_tambah' => 1000],
                    ['nama' => 'Extra Nasi', 'harga_tambah' => 3000]
                ]
            ],
            [
                'nama_produk' => 'Sate Ayam',
                'deskripsi' => 'Sate ayam dengan bumbu kacang',
                'harga' => 18000,
                'kategori' => 'Makanan',
                'varian' => null
            ],

            // Minuman
            [
                'nama_produk' => 'Kopi Hitam',
                'deskripsi' => 'Kopi hitam pekat',
                'harga' => 8000,
                'kategori' => 'Minuman',
                'varian' => [
                    ['nama' => 'Dingin', 'harga_tambah' => 2000],
                    ['nama' => 'Extra Shot', 'harga_tambah' => 3000]
                ]
            ],
            [
                'nama_produk' => 'Teh Manis',
                'deskripsi' => 'Teh manis hangat',
                'harga' => 5000,
                'kategori' => 'Minuman',
                'varian' => [
                    ['nama' => 'Dingin', 'harga_tambah' => 1000],
                    ['nama' => 'Less Sugar', 'harga_tambah' => 0]
                ]
            ],
            [
                'nama_produk' => 'Jus Jeruk',
                'deskripsi' => 'Jus jeruk segar',
                'harga' => 12000,
                'kategori' => 'Minuman',
                'varian' => null
            ]
        ];

        foreach ($produk as $item) {
            \App\Models\Produk::create($item);
        }
    }
}
