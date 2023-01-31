<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
        'status',
        'customization_details'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
