<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order as ResourcesOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesOrder::collection($orders),
            'All Orders sent'
        );
    }

    public function ordersTrashed()
    {
        // $orders = Order::onlyTrashed()->where('user_id', Auth::id())->get();
        $orders = Order::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesOrder::collection($orders),
            'All Order sent'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  $request->name,
            'email' =>  $request->email,
            'phone_number' =>  $request->phone_number,
            'company' =>  $request->company,
            'details' =>  $request->details,
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }

        $order = Order::create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'phone_number' =>  $request->phone_number,
            'company' =>  $request->company,
            'details' =>  $request->details,
        ]);

        return $this->sendResponse(new ResourcesOrder($order), 'Order created successfully');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return $this->sendResponse(new ResourcesOrder($order), 'Order deleted successfully');
    }


    public function hdelete(Order $order)
    {
        $order->forceDelete();
        return $this->sendResponse(new ResourcesOrder($order), 'Order deleted successfully');
    }

    public function restore($id)
    {
        $order = Order::onlyTrashed()->find($id);
        $order->restore();
        return $this->sendResponse(new ResourcesOrder($order), 'Order deleted successfully');
    }
}
