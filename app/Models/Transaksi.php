<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'total_harga',
        'uang_dibayar',
        'kembalian',
        'kasir_id'
    ];

    protected $casts = [
        'total_harga' => 'integer',
        'uang_dibayar' => 'integer',
        'kembalian' => 'integer'
    ];

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }
}
