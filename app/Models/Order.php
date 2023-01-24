<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_code',
        'customer_id',
        'payment_method',
        'payment_status',
        'subtotal_amount',
        'discount_amount',
        'delivery_charge',
        'total_amount', //total_amount = (subtotal_amount - discount_amount) + delivery_charge
        'status',
        'delivery_address',
    ];
}
