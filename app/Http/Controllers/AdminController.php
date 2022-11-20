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
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
                'store_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ]);
            }


            $store = Store::create($request->all());

            if (!empty($request->store_image)) {
                $file = $request->file('store_image');
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('store_images/'), $filename);
                $$store['store_image'] = 'public/store_images/' . $filename;
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
