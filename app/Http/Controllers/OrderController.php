<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{


    public function checkout_index()
    {
        if (auth()->user() && auth()->user()->is_admin !== 1) {
            $calculatedProducts = calculateCartedProducts();

            $products = $calculatedProducts['products'];
            $subtotal = $calculatedProducts['subtotal'];

            $customer = [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address,
            ];

            return view('frontend.checkout', [
                'customer' => $customer,
                'products' => $products,
                'subtotal' => $subtotal,
                'delivery_charge' => 50
            ]);
        } else {
            return redirect()->route('login');
        }
    }


    //validate information
    //validate product
    //create order 
    //create orderdeails 
    //update order 
    //return redirect to order/:orderCode
    public function place_order()
    {
        if (auth()->user() && auth()->user()->is_admin !== 1) {
            $order_code = 'AJ-' . uniqid();
            $calculatedProducts = calculateCartedProducts();


            $products = $calculatedProducts['products'];
            $subtotal = $calculatedProducts['subtotal'];

            $customer = [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address,
            ];

            // 'customer_id',
            // 'customer_name',
            // 'phone',
            // 'email',
            // 'order_note',
            // 'payment_method',
            // 'payment_status',
            // 'subtotal_amount',
            // 'delivery_charge',
            // 'total_amount', //total_amount = subtotal_amount + delivery_charge
            // 'status',
            // 'delivery_address',

            dd($customer['id']);

            //make an order
            $order = Order::create([
                'order_code' => $order_code,
                'customer_id' => $customer['id'],
                'customer_id' => $customer['id'],

            ]);

            return view('frontend.checkout', [
                'customer' => $customer,
                'products' => $products,
                'subtotal' => $subtotal,
                'delivery_charge' => 50
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}
