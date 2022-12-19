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
        'size',
        'images',
        'customization_available',
        'customaization_instructions',
        'published',
        'categories',
        'description',
        'physical_store'
    ];
}
