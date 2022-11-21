<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
        'price',
        'karat',
        'stock',
        'size',
        'customization_available',
        'images',
        'published',
        'categories',
        'description',
    ];
}