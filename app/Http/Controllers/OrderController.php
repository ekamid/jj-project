<?php

namespace App\Http\Controllers;

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
            $order_code = 'AJ-' . uniqid();

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

    public function confirm_order()
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
}
