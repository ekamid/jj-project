<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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


    public function stores()
    {
        return view('store.index');
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
                'close_at' => $request->get('close_at'),
                'published' => $request->get('published') ?? false,
            ]);

            if (!empty($request->store_image)) {
                $file = $request->file('store_image');
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('store_images/'), $filename);
                $store['store_image'] = 'public/store_images/' . $filename;
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
