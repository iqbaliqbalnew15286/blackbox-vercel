<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'position',
    ];
}
