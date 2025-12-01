<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananSalon extends Model
{
    use HasFactory;

    protected $table = 'layanan_salon';

    protected $fillable = [
        'name',
        'description',
        'photo',
        'price',
        'category',
        'is_visible',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_visible' => 'boolean',
    ];
}
