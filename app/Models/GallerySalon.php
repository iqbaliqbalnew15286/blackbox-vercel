<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySalon extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'description',
    ];
}
