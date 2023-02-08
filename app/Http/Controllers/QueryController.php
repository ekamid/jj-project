<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Query;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function queries()
    {
        try {
            $data = Query::where('reply_to', null)->get();
            return view("queries.index", [
                'queries' => $data
            ]);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }


    public function query_chat(Request $request, $id)
    {
        // orderBy('created_at', 'desc')->
        if ($request->method() == 'GET') {
            try {
                $query = Query::where('id', '=', $id)->first();

                if (!$query) {
                    return redirect()->back()->with(
                        'error',
                        'Query does not exist!'
                    );
                }

                $queries = Query::where(function ($query) use ($id) {
                    $query->where('id', '=', $id)
                        ->orWhere('reply_to', '=', $id);
                })->get();

                return view("queries.chat",  ['queries' => $queries, 'user' => $query->user]);
            } catch (Exception $e) {
                return redirect()->back();
            }
        }

        if ($request->method() == 'POST') {
            $request->validate([
                'description' => 'required',
            ]);

            $parentQuery = Query::find($id);


            $query = Query::create([
                'created_by' => auth()->user()->id,
                'reply_to' => $id,
                'description' => $request->get('description'),
            ]);

            $parentQuery->update(['answered' => false]);



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

            return redirect()->route("admin.user.queries")->with(
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
