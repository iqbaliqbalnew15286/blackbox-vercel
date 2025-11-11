<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'kategori',
        'varian',
        'foto'
    ];

    protected $casts = [
        'varian' => 'array',
        'harga' => 'integer'
    ];

    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class);
    }
}
