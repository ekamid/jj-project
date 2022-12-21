<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (!auth()->user()->isAdmin) {
                return view('frontend.user.dashboard');
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }
}
