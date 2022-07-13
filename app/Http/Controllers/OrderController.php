<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('orders.index')->with('orders', $orders);
    }

    public function ordersTrashed()
    {
        $orders = Order::onlyTrashed()->get();
        return view('orders.trashed')->with('orders', $orders);
    }


    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $order = Order::withTrashed()->where('id',  $id)->first();
        $order->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->where('id',  $id)->first();
        $order->restore();
        return redirect()->back();
    }
}
