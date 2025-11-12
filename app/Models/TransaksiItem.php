<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $table = 'transaksi_items';

    protected $fillable = [
        'transaksi_id',
        'menu_id', // ✅ kolom relasi ke menu_items
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'qty' => 'integer',
        'harga_satuan' => 'integer',
        'subtotal' => 'integer',
    ];

    /**
     * Relasi ke model Transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    /**
     * Relasi ke model MenuItem
     */
    public function menu()
    {
        return $this->belongsTo(MenuItem::class, 'menu_id');
    }
}
