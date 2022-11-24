<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminController extends Controller
{

    public function dashboard()
    {
        return view('dashboard');
    }

    public function products()
    {
        return view('products');
    }


    //category

    public function categories()
    {
        $categories = Category::all();

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function add_category(Request $request)
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'name' => 'required|unique:categories,name',
                'banner' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);


            $store = Category::create([
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name')),
                'parent_id' => $request->get('parent_id'),
                'description' => $request->get('description'),
                'published' => $request->get('published') ? true : false,
            ]);

            if (!empty($request->banner)) {
                $file = $request->file('banner');
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('banner/'), $filename);
                $store['banner'] = '/banner/' . $filename;
            }

            $store->save();

            if ($store) {
                return redirect()->route('admin.categories')->with(
                    'success',
                    'Categories successfully added!'
                );
            }

            return redirect()->route('agent')->with(
                'success',
                'Store successfully added!'
            );
        }
        if ($request->method() === 'GET') {
            $categories = Category::all();

            return view("category.add", [
                'categories' => $categories
            ]);
        }
    }


    public function edit_category(Request $request, $id)
    {

        $category = Category::where('id', $id)->first();
        $categories = Category::all();


        if (!$category) {
            return redirect()->route('admin.categories')->with(
                'error',
                'The category no longer available'
            );
        }


        if ($request->method() === 'POST') {

            $request->validate([
                'name' => 'required|unique:categories,name,' . $id,
                'banner' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);


            $category->update([
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name')),
                'parent_id' => $request->get('parent_id'),
                'description' => $request->get('description'),
                'published' => $request->get('published') ? true : false,
            ]);

            if (!empty($request->banner)) {
                $file = $request->file('banner');
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('banner/'), $filename);
                $store['banner'] = '/banner/' . $filename;
            }

            $category->save();

            if ($category) {
                return redirect()->route('admin.categories')->with(
                    'success',
                    'Category successfully updated!'
                );
            }

            return redirect()->back()->with(
                'error',
                'Something went wrong!'
            );
        }

        if ($request->method() === 'GET') {
            return view('category.edit', [
                'categories' => $categories,
                'category' => $category
            ]);
        }
    }

    public function delete_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();


        if (!$category) {
            return redirect()->route('admin.stores')->with(
                'error',
                'The store no longer available'
            );
        }

        $deleted = $category->delete();

        if ($deleted) {
            return redirect()->route('admin.categories')->with(
                'success',
                'Category successfully deleted!'
            );
        }


        return redirect()->back()->with(
            'error',
            'Something went wrong!'
        );
    }


    //stores

    public function stores()
    {
        $stores = Store::all();

        return view('store.index', [
            'stores' => $stores
        ]);
    }

    public function add_store(Request $request)
    {
        if ($request->method() === 'POST') {

            $request->validate([
                'name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
                'store_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);



            $store = Store::create([
                'name' => $request->get('name'),
                'city' => $request->get('city'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone') ?? null,
                'latitude' => $request->get('latitude') ?? null,
                'longitude' => $request->get('longitude') ?? null,
                'instructions' => trim($request->get('instructions')),
                'holidays' => $request->get('holidays'),
                'open_at' => $request->get('open_at'),
                'close_at' => $request->get('close_at'), 'published' => $request->get('published') ? true : false,

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
                    'Store successfully added!'
                );
            }

            return redirect()->route('agent')->with(
                'success',
                'Store successfully added!'
            );
        }
        if ($request->method() === 'GET') {
            return view('store.add_store');
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


    //authentication

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        if ($request->isMethod('GET')) {
            return view('auth.dashboard.login');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('admin/dashboard')
                    ->withSuccess('Signed in');
            }

            return redirect()->route('admin.login')->with('error-message', 'Login credentials are not valid');
        }
    }
}
