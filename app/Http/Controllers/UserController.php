<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Query;
use App\Models\User;
use Exception;
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

    public function queries()
    {
        if (Auth::check()) {
            if (!auth()->user()->isAdmin) {
                $data = Query::where('created_by', auth()->user()->id)->where('reply_to', null)->get();
                return view('frontend.queries.index', [
                    'queries' => $data
                ]);
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function create_query(Request $request)
    {
        if (Auth::check()) {


            if (!auth()->user()->isAdmin) {
                if ($request->method() == 'POST') {
                    try {
                        $userId = auth()->user()->id;

                        $request->validate([
                            'title' => 'required',
                            'description' => 'required',
                            'order_id' => $request->get('type') === 'order' ? 'required' : '',
                        ]);

                        $order = null;

                        if ($request->get('type') === 'order') {
                            $result = Order::where('customer_id', $userId)->where('id', $request->get('order_id'))->first();
                            if ($result) {
                                $order = $request->get('order_id');
                            } else {
                                return redirect()->back()->with(
                                    'error',
                                    'Order Not found!'
                                );
                            }
                        }


                        $query = Query::create([
                            'created_by' => $userId,
                            'title' => $request->get('title'),
                            'description' => $request->get('description'),
                            'type' => $request->get('type'),
                            'order_id' => $order
                        ]);

                        if ($query) {
                            return redirect()->route("frontend.user.queries")->with(
                                'success',
                                'Query created successfully!'
                            );
                        }

                        return redirect()->back()->with(
                            'error',
                            'Query creation failed!'
                        );
                    } catch (Exception $e) {
                        dd($e);
                        return redirect()->back()->with(
                            'error',
                            'Something went wrong!'
                        );
                    }
                }

                if ($request->method() == 'GET') {
                    return view('frontend.queries.add');
                }
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function create_query_reply(Request $request, $id)
    {
        if (Auth::check()) {
            if (!auth()->user()->isAdmin) {

                $request->validate([
                    'description' => 'required',
                ]);

                $query = Query::create([
                    'created_by' => auth()->user()->id,
                    'reply_to' => $id
                ]);

                if ($query) {
                    return redirect()->back()->with(
                        'success',
                        'Query created successfully!'
                    );
                }

                return redirect()->back()->with(
                    'error',
                    'Query creation failed!'
                );
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect('login');
        }
    }
}
