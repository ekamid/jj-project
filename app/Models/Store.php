<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'latitude',
        'longitude',
        'instructions',
        'store_image',
        'city',
        'published',
    ];
}
