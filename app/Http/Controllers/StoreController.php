<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //stores

    public function index()
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
                return redirect()->route('admin.stores.index')->with(
                    'success',
                    'Store successfully added!'
                );
            }
        }
        if ($request->method() === 'GET') {
            return view('store.add');
        }
    }


    public function edit_store(Request $request, $id)
    {

        $store = Store::where('id', $id)->first();


        if (!$store) {
            return redirect()->route('admin.stores.index')->with(
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


            $store->update([
                'name' => $request->get('name'),
                'city' => $request->get('city'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone') ?? null,
                'latitude' => $request->get('latitude') ?? null,
                'longitude' => $request->get('longitude') ?? null,
                'instructions' => $request->get('instructions'),
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
                return redirect()->route('admin.stores.index')->with(
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
            return view('store.edit', [
                'store' => $store
            ]);
        }
    }

    public function delete_store(Request $request, $id)
    {
        $store = Store::where('id', $id)->first();


        if (!$store) {
            return redirect()->route('admin.stores.index')->with(
                'error',
                'The store no longer available'
            );
        }

        $deleted = $store->delete();

        if ($deleted) {
            return redirect()->route('admin.stores.index')->with(
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
