<?php

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('uploadProductImages')) {
    function uploadProductImages($images)
    {
        if (!empty($images)) {
            $uploaded = [];
            foreach ($images as $file) {
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/products/'), $filename);
                array_push($uploaded, '/uploads/products/' . $filename);
            }

            return $uploaded;
        }

        return null;
    }
}

if (!function_exists('selectedSize')) {
    function selectedSize($value, $arr)
    {
        return in_array($value, json_decode($arr)) ? 'selected' : '';
    }
}

if (!function_exists('calculateCartedProducts')) {
    function calculateCartedProducts()
    {
        $cartedItems = '';

        if (Cookie::get('cartedItems')) {
            $cartedItems = json_decode(Cookie::get('cartedItems'));
        }


        $products = [];
        $subtotal = 0;
        $total_quantity = 0;


        foreach ($cartedItems as  $item) {
            $product = Product::find($item->id);

            if ($product) {
                if ($product->stock >= $item->quantity) {
                    array_push($products, [
                        'id' => $product->id,
                        'name' => $product->name,
                        'quantity' => $item->quantity,
                        'price' => $product->price,
                    ]);
                    $subtotal += $product->price * $item->quantity;
                    $total_quantity += $item->quantity;
                }
            }
        }

        return [
            'products' => $products,
            'subtotal' => $subtotal,
            'total_quantity' => $total_quantity,
        ];
    }
}
