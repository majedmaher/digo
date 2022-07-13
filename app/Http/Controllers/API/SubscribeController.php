<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Subscribe as ResourcesSubscribe;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends BaseController
{
    public function index()
    {
        $subscribes = Subscribe::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesSubscribe::collection($subscribes),
            'All Subscribes sent'
        );
    }

    public function subscribesTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $subscribes = Subscribe::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesSubscribe::collection($subscribes),
            'All Subscribes sent'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>   $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }

        $subscribe = Subscribe::create([
            'user_id' =>  Auth::id(),
            'name' =>   $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        return $this->sendResponse(new ResourcesSubscribe($subscribe), 'Subscribe created successfully');
    }


    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();
        return $this->sendResponse(new ResourcesSubscribe($subscribe), 'Subscribe deleted successfully');
    }


    public function hdelete(Subscribe $subscribe)
    {
        $subscribe->forceDelete();
        return $this->sendResponse(new ResourcesSubscribe($subscribe), 'Subscribe deleted successfully');
    }

    public function restore($id)
    {
        $subscribe = Subscribe::onlyTrashed()->find($id);
        $subscribe->restore();
        return $this->sendResponse(new ResourcesSubscribe($subscribe), 'Subscribe deleted successfully');
    }
}
