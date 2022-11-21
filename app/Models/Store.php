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
        'holidays',
        'close_at',
        'open_at',
        'store_image',
        'city',
        'instructions',
        'published',
    ];
}
