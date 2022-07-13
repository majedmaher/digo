<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;


class SubscribeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subscribes = Subscribe::orderBy('created_at', 'DESC')->get();
        return view('subscribe.index')->with('subscribes', $subscribes);
    }

    public function subscribesTrashed()
    {
        $subscribes = Subscribe::onlyTrashed()->get();
        return view('subscribe.trashed')->with('subscribes', $subscribes);
    }

    public function destroy($id)
    {
        $subscribe = Subscribe::find($id);

        $subscribe->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $subscribe = Subscribe::withTrashed()->where('id',  $id)->first();
        $subscribe->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $subscribe = Subscribe::withTrashed()->where('id',  $id)->first();
        $subscribe->restore();
        return redirect()->back();
    }
}
