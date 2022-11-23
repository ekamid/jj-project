<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function find_stores(Request $request)
    {

        //what I'm doing

        //show all published stores when the page is loaded
        //select city by store name
        //find it on map
        //on marker click it will send to store details page


        if ($request->method() === 'GET') {

            $stores = Store::where('published', 1)->get();;

            $data = [];

            foreach ($stores as $store) {
                $data[$store['city']][] = $store;
            }

            return view('frontend.find_stores', [
                'stores' => $data,
            ]);
        }
    }
}
