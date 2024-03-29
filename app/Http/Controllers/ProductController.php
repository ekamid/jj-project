<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductByCategory;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortByDesc("id");

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function add_product(Request $request)
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'name' => 'required',
                'slug' => 'string|unique:products,slug',
                'weight' => 'required|numeric|gt:0',
                'price' => 'required|numeric|gt:0',
                'karat' => 'required|numeric|gt:0',
                'stock'  => 'required|integer|gt:0',
                'images.*' => 'mimes:png,jpg,jpeg|max:2048',
            ]);


            $productName = trim($request->get('name'));

            $product = Product::create([
                'name' => $productName,
                'slug' => Str::slug($productName, '-') . '-' . time(),
                'price' => $request->get('price'),
                'weight' => $request->get('weight'),
                'karat' => $request->get('karat'),
                'stock' => $request->get('stock'),
                'physical_store' => json_encode($request->get('physical_store')) ?? null,
                'description' => trim($request->get('description')) ?? null,
                'published' => $request->get('published') ? true : false,
            ]);

            $categories = $request->get('categories') ? $request->get('categories') : [];


            if ($product && !empty($categories)) {
                foreach ($categories as $item) {
                    ProductByCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $item
                    ]);
                }
            }

            $product['images'] = uploadProductImages($request->images);


            $product->save();

            if ($product) {
                return redirect()->route("admin.products.index")->with(
                    'success',
                    'Product successfully added!'
                );
            }

            return redirect()->route('agent')->with(
                'success',
                'Store successfully added!'
            );
        }

        if ($request->method() === 'GET') {
            $categories = Category::where('published', 1)->get();
            $stores = Store::where('published', 1)->get();
            return view('products.add', [
                'categories' => $categories,
                'stores' => $stores
            ]);
        }
    }


    public function edit_product(Request $request, $id)
    {

        // dd($request->all());

        $product = Product::where('id', $id)->first();


        if (!$product) {
            return redirect()->route('admin.products.index')->with(
                'error',
                'The product no longer available'
            );
        }


        if ($request->method() === 'POST') {

            $request->validate([
                'name' => 'required',
                'weight' => 'required|numeric|gt:0',
                'price' => 'required|numeric|gt:0',
                'karat' => 'required|numeric|gt:0',
                'stock'  => 'required|integer|gt:0',
                'images.*' => 'mimes:png,jpg,jpeg|max:2048',
            ]);

            $productName = trim($request->get('name'));

            $product->update([
                'name' => $productName,
                'price' => $request->get('price'),
                'weight' => $request->get('weight'),
                'karat' => $request->get('karat'),
                'stock' => $request->get('stock'),
                'physical_store' => json_encode($request->get('physical_store')) ?? null,
                'description' => trim($request->get('description')) ?? null,
                'published' => $request->get('published') ? true : false,
            ]);


            ProductByCategory::where('product_id', $product->id)->delete();

            $categories = $request->get('categories') ? $request->get('categories') : [];

            if ($product && !empty($categories)) {
                foreach ($categories as $item) {
                    ProductByCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $item
                    ]);
                }
            }


            $uploaded = uploadProductImages($request->images);

            $product['images'] = $uploaded ? $uploaded : $product['images'];


            $product->save();

            if ($product) {
                return redirect()->route('admin.products.index')->with(
                    'success',
                    'Store successfully updated!'
                );
            }

            return redirect()->back()->with(
                'error',
                'Something went wrong!'
            );
        }

        if ($request->method() === 'GET') {
            $categories = Category::where('published', 1)->get();
            $productByCategory = ProductByCategory::where('product_id', $id)->pluck('category_id');
            $stores = Store::where('published', 1)->get();

            return view('products.edit', [
                'product' => $product,
                'categories' => $categories,
                'productByCategory' => $productByCategory,
                'stores' => $stores
            ]);
        }
    }

    public function delete_product(Request $request, $id)
    {
        $store = Product::where('id', $id)->first();


        if (!$store) {
            return redirect()->route('admin.products.index')->with(
                'error',
                'The product no longer available'
            );
        }

        $deleted = $store->delete();

        if ($deleted) {
            return redirect()->route('admin.products.index')->with(
                'success',
                'Product successfully deleted!'
            );
        }


        return redirect()->back()->with(
            'error',
            'Something went wrong!'
        );
    }
}
