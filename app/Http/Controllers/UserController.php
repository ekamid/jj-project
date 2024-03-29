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
                            'order_code' => $request->get('type') === 'order' ? 'required' : '',
                        ]);

                        $order = null;

                        if ($request->get('type') === 'order') {
                            $result = Order::where('customer_id', $userId)->where('order_code', $request->get('order_code'))->first();
                            if ($result) {
                                $order = $request->get('order_code');
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
                            'order_code' => $order
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




    public function query_chat(Request $request, $id)
    {
        // orderBy('created_at', 'desc')->
        if ($request->method() == 'GET') {

            if (Auth::check()) {
                if (!auth()->user()->isAdmin) {


                    $parentQuery = Query::find($id);


                    $queries = Query::where(function ($query) use ($id) {
                        $query->where('id', '=', $id)
                            ->orWhere('reply_to', '=', $id);
                    })->get();

                    $parentQuery->update(['answered' => false]);
                    return view("frontend.queries.chat",  ['queries' => $queries]);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {
                return redirect('login');
            }
        }

        if ($request->method() == 'POST') {
            $request->validate([
                'description' => 'required',
            ]);

            $query = Query::create([
                'created_by' => auth()->user()->id,
                'reply_to' => $id,
                'description' => $request->get('description'),
                'answered' => false,
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
        }
    }




    public function delete_query(Request $request, $id)
    {

        try {
            $query = Query::where('id', $id)->first();


            if (!$query) {
                return redirect()->back()->with(
                    'error',
                    'The query no longer available'
                );
            }

            $deleted = $query->delete();

            if ($deleted) {
                return redirect()->back()->with(
                    'success',
                    'Order successfully deleted!'
                );
            }

            return redirect()->back()->with(
                'error',
                'Something went wrong!'
            );
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function close_query(Request $request, $id)
    {

        try {
            $query = Query::where('id', $id)->first();


            if (!$query) {
                return redirect()->back()->with(
                    'error',
                    'The query no longer available'
                );
            }

            $query->update([
                'answered' => true
            ]);

            return redirect()->route("frontend.user.queries")->with(
                'success',
                'Query has been Closed!'
            );
        } catch (Exception $e) {
            return redirect()->back()->with(
                'error',
                'Something went wrong!'
            );
        }
    }
}
