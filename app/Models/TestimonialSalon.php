<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialSalon extends Model
{
    protected $table = 'testimonial_salon';

    protected $fillable = [
        'name',
        'role',
        'quote',
        'avatar',
        'rating',
    ];
}
