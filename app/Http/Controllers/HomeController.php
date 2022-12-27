<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductByCategory;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home_index(Request $request)
    {
        $categories = Category::where('published', true)->get();
        $categoryByProducts = ProductByCategory::all();

        dd($categoryByProducts);

        return view('home', [
            'categories' => $categories
        ]);
    }

    public function shop_index(Request $request)
    {
        $products = Product::where('published', true)->paginate(15);
        // dd($products);
        return view('shop', [
            'products' => $products
        ]);
    }

    public function find_stores(Request $request)
    {
        //city wise search (future)
        if ($request->method() === 'GET') {

            $stores = Store::where('published', 1)->get();

            $data = [];

            foreach ($stores as $store) {
                $data[$store['city']][] = $store;
            }

            return view('frontend.find_stores', [
                'stores' =>
                $stores,
            ]);
        }
    }

    public function get_stores(Request $request)
    {
        $stores = Store::where('published', 1)->get();

        return response()->json($stores);
    }

    public function find_single_store(Request $request, $id)
    {

        $store = Store::where('id', $id)->first();


        if (!$store) {
            return redirect()->route("frontend.find_stores")->with(
                'error',
                'The store no longer available'
            );
        }

        return view("frontend.single_store_details", [
            'store' => $store
        ]);
    }
}
