<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'weight',
        'price',
        'karat',
        'stock',
        'images',
        'published',
        'categories',
        'description',
        'physical_store'
    ];
}
