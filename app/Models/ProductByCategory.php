<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductByCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id'
    ];
}
