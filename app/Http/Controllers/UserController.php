<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        if (Auth::check()) {

            if (auth()->user()->is_admin !== 1) {
                return view('frontend.user.dashboard');
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function edit(Request $request)
    {

        if (Auth::check()) {
            if (!auth()->user()->isAdmin) {
                if ($request->method() == 'POST') {

                    $request->validate([
                        'name' => 'required',
                        'email' => 'string|unique:products,slug',
                        'phone' => 'required|numeric|gt:0',
                        'avater.*' => 'mimes:png,jpg,jpeg|max:2048',
                    ]);

                    $user = User::find(auth()->user()->id);

                    $user['name'] = $request->name;
                    $user['email'] = $request->email;
                    $user['phone'] = $request->phone;
                    $user['address'] = $request->address ? $request->address : null;

                    // $user['avater'] = uploadProductImages($request->avater);

                    $user->save();


                    return redirect()->route('frontend.user.dashboard');
                }
                if ($request->method() == 'GET') {
                    return view('frontend.user.edit');
                }
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }
}
