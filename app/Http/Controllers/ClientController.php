<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clients = Client::orderBy('created_at', 'DESC')->get();
        return view('client.index')->with('clients', $clients);
    }

    public function clientsTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $clients = Client::onlyTrashed()->get();
        return view('client.trashed')->with('clients', $clients);
    }
    public function create()
    {
        return view('client.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' =>  'required',
            'photo' =>  'required|image',
        ]);
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/clients', $newPhoto);

        $client = Client::create([
            'user_id' =>  Auth::id(),
            'content' =>   $request->content,
            'photo' =>  'uploads/clients/' . $newPhoto,
        ]);

        return redirect()->back();
    }
    public function show($id)
    {
        $client = Client::find($id);
        return view('client.show')->with('client', $client);
    }


    public function edit($id)
    {
        $client = Client::find($id);
        if ($client === null) {
            return redirect()->back();
        }
        return view('client.edit')->with('client', $client);
    }

    public function update(Request $request,  $id)
    {
        $client = Client::find($id);
        $this->validate($request, [
            'content' =>  'required'
        ]);

        //   dd($request->all());

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/clients', $newPhoto);
            $client->photo = 'uploads/clients/' . $newPhoto;
        }

        $client->content = $request->content;
        $client->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //dd($id);
        $client = Client::find($id);

        // $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        // if ($blog === null) {
        //     return redirect()->back();
        // }

        $client->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $client = Client::withTrashed()->where('id',  $id)->first();
        $client->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $client = Client::withTrashed()->where('id',  $id)->first();
        $client->restore();
        return redirect()->back();
    }
}
