<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'total_harga',
        'uang_dibayar',
        'kembalian',
        'kasir_id',
    ];

    protected $casts = [
        'total_harga' => 'integer',
        'uang_dibayar' => 'integer',
        'kembalian' => 'integer',
    ];

    // Relasi ke kasir (user)
    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    // Relasi ke item transaksi (menu)
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}
