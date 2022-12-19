<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortByDesc("id");;

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
                'size'  => 'required',
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
                'size' => json_encode($request->get('size')),
                'categories' => json_encode($request->get('categories')) ?? null,
                'physical_store' => json_encode($request->get('physical_store')) ?? null,
                'description' => trim($request->get('description')) ?? null,
                'customization_available' => $request->get('customization_available') ? true : false,
                'customaization_instructions' => trim($request->get('customaization_instructions')) ?? null,
                'published' => $request->get('published') ? true : false,

            ]);

            // dd($request->images);


            if (!empty($request->images)) {
                $images = [];

                foreach ($request->file('images') as $file) {
                    $extension = $file->extension();
                    $filename = time() . '.' . $extension;
                    $file->move(public_path('uploads/products/'), $filename);
                    array_push($images, '/uploads/products/' . $filename);
                }

                $product['images'] = $images;
            }

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


    public function edit_store(Request $request, $id)
    {

        $store = Store::where('id', $id)->first();


        if (!$store) {
            return redirect()->route('admin.stores')->with(
                'error',
                'The store no longer available'
            );
        }


        if ($request->method() === 'POST') {

            $request->validate([
                'name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
                'store_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);

            // dd($request->get('published'));

            $store->update([
                'name' => $request->get('name'),
                'city' => $request->get('city'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone') ?? null,
                'latitude' => $request->get('latitude') ?? null,
                'longitude' => $request->get('longitude') ?? null,
                'instructions' => trim($request->get('instructions')),
                'holidays' => $request->get('holidays'),
                'open_at' => $request->get('open_at'),
                'close_at' => $request->get('close_at'),
                'published' => $request->get('published') ? true : false,
            ]);

            if (!empty($request->store_image)) {
                $file = $request->file('store_image');
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('store_images/'), $filename);
                $store['store_image'] = '/store_images/' . $filename;
            }

            $store->save();

            if ($store) {
                return redirect()->route('admin.stores')->with(
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
            return view('store.edit_store', [
                'store' => $store
            ]);
        }
    }

    public function delete_store(Request $request, $id)
    {
        $store = Store::where('id', $id)->first();


        if (!$store) {
            return redirect()->route('admin.stores')->with(
                'error',
                'The store no longer available'
            );
        }

        $deleted = $store->delete();

        if ($deleted) {
            return redirect()->route('admin.stores')->with(
                'success',
                'Store successfully deleted!'
            );
        }


        return redirect()->back()->with(
            'error',
            'Something went wrong!'
        );
    }
}
