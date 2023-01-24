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
        'customer_name',
        'phone',
        'email',
        'order_note',
        'payment_method',
        'payment_status',
        'subtotal_amount',
        'delivery_charge',
        'total_amount', //total_amount = subtotal_amount + delivery_charge
        'status',
        'delivery_address',
    ];
}
