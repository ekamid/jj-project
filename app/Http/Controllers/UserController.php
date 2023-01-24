<?php

namespace App\Http\Controllers;

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
