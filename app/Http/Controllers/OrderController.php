<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{

    public function index()
    {
        if (auth()->user() && auth()->user()->is_admin !== 1) {
            $orders = Order::where('customer_id', '=', auth()->user()->id)->get();

            return view("frontend.user.orders", [
                'orders' => $orders,
            ]);
        } else {
            return redirect()->route('login');
        }
    }

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

    public function place_order(Request $request)
    {
        try {
            // dd($request->all());
            if (auth()->user() && auth()->user()->is_admin !== 1) {

                $request->validate([
                    'customer_name' =>
                    ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'phone' => ['required', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
                    'delivery_address' => ['required', 'string'],
                ]);

                $calculatedProducts = calculateCartedProducts();

                $products = $calculatedProducts['products'];
                $subtotal = $calculatedProducts['subtotal'];
                $total_quantity = $calculatedProducts['total_quantity'];


                if (!count($products)) {
                    dd('returning back');
                    return redirect()->back();
                }


                $order_code = 'AJ-' . uniqid();

                $customer = [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'address' => auth()->user()->address,
                ];


                $delivery_charge = 50;


                //create an order
                $order = Order::create([
                    'order_code' => $order_code,
                    'customer_id' => $customer['id'],
                    'delivery_address' => $request->delivery_address,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'customer_name' => $request->customer_name,
                    'order_note' => $request->order_node && strlen(trim($request->order_note)) ? $request->order_node : null,
                    'delivery_charge' => $delivery_charge,
                    'subtotal_amount' => $subtotal,
                    'total_amount' => $subtotal + $delivery_charge,
                    'total_quantity' => $total_quantity,
                ]);


                if (!$order) {
                    dd('error');

                    return redirect()->back()->with('error', 'something went wrong');
                }

                foreach ($products as $product) {
                    Product::where("id", $product['id'])->update(["stock" => $product['stock'] - $product['quantity']]);
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                    ]);
                }

                Cookie::queue(Cookie::forget('cartedItems'));

                return redirect()->route('frontend.order_invoice', ['order_code' => $order->order_code]);
            } else {
                return redirect()->route('login');
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    public function order_invoice(Request $request, $order_code)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $order = Order::where('order_code', $order_code)->first();

        if (!$order) {
            return redirect()->route('home');
        }


        if (auth()->user() && auth()->user()->id !== $order->customer_id) {
            return redirect()->route('home');
        }

        $orderedProducts = $order->products;

        return view('frontend.order_invoice', [
            'order' => $order,
            'products' => $orderedProducts
        ]);
    }


    public function order_details(Request $request, $order_code)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $order = Order::where('order_code', $order_code)->first();

        if (!$order) {
            return redirect()->route('home');
        }


        if (auth()->user() && auth()->user()->id !== $order->customer_id) {
            return redirect()->route('home');
        }

        $orderedProducts = $order->products;

        return view('frontend.user.order_details', [
            'order' => $order,
            'products' => $orderedProducts
        ]);
    }
}
