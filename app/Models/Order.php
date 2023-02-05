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
        'subtotal_amount',
        'total_quantity',
        'delivery_charge',
        'total_amount', //total_amount = subtotal_amount + delivery_charge
        'paid_amount',
        'payment_status',
        'status',
        'delivery_address',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\OrderDetails');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
