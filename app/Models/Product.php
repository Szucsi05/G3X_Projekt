<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'platform',
        'genre',
        'category',
        'release_year',
        'prices',
    ];

    protected $casts = [
        'prices' => 'json',
    ];
}
