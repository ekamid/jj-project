<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductByCategory;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home_index()
    {
        $data = [];
        $productByCategories = ProductByCategory::all()->pluck('category_id')->unique();

        foreach ($productByCategories as $key => $item) {

            $products = [];

            $category = Category::where('id', $item)->where('published', true)->first();

            $categoryProduct = ProductByCategory::where('category_id', $item)->take(3)->get();

            foreach ($categoryProduct as $itemProduct) {
                $product = Product::where('id', $itemProduct->product_id)->where('published', true)->first();
                array_push($products, $product);
            }

            $data[$key]['products'] = $products;
            $data[$key]['category'] = $category;
        }

        return view('home', [
            'data' => $data
        ]);
    }

    public function shop_index()
    {
        $products = Product::where('published', true)->paginate(15);

        return view('shop', [
            'products' => $products
        ]);
    }

    public function product_search(Request $request)
    {
        if ($request->method() === 'GET') {



            $searchTerm = $request->query('keywrods');

            $products = [];

            if (trim($searchTerm, '') !== '') {
                $products = DB::table('products')
                    ->where('name', 'LIKE', "%{$searchTerm}%")
                    ->where('published', true)
                    ->get();
            }


            return view('search', [
                'products' => $products
            ]);
        }

        if ($request->method() === 'POST') {
            // dd($request->all());
            $searchTerm = $request->get('search_term');

            return redirect('/search?keywrods=' . $searchTerm);
        }
    }

    public function cart_index()
    {
        return view('frontend.cart');
    }


    public function product_details(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $store_ids = json_decode($product->physical_store);
        $stores = $store_ids ? Store::whereIn('id', $store_ids)->get() : null;

        return view('product_details', [
            'product' => $product,
            'stores' => $stores
        ]);
    }

    public function check_product_stock(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
        ], 200);
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
