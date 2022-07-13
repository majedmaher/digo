<?php

namespace App\Http\Controllers;

use App\Models\Services;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $services = Services::orderBy('created_at', 'DESC')->get();
        return view('service.index')->with('services', $services);
    }

    public function servicesTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $services = Services::onlyTrashed()->get();
        return view('service.trashed')->with('services', $services);
    }
    public function create()
    {
        return view('service.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'content' =>  'required',
            'photo' =>  'required|image',
        ]);
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/services', $newPhoto);
        $service = Services::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/services/' . $newPhoto,
            'slug' =>   str_slug($request->title),
        ]);
        return redirect()->back();
    }
    public function show($slug)
    {
        $service = Services::where('slug', $slug)->first();
        return view('service.show')->with('service', $service);
    }


    public function edit($slug)
    {
        $service = Services::where('slug', $slug)->first();
        if ($service === null) {
            return redirect()->back();
        }
        return view('service.edit')->with('service', $service);
    }

    public function update(Request $request,  $slug)
    {
        $service = Services::where('slug', $slug)->first();
        $this->validate($request, [
            'title' =>  'required',
            'content' =>  'required'
        ]);

        //   dd($request->all());

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/services', $newPhoto);
            $service->photo = 'uploads/services/' . $newPhoto;
        }

        $service->title = $request->title;
        $service->content = $request->content;
        $service->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //dd($id);
        $service = Services::find($id);

        // $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        // if ($blog === null) {
        //     return redirect()->back();
        // }

        $service->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $service = Services::withTrashed()->where('id',  $id)->first();
        $service->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $service = Services::withTrashed()->where('id',  $id)->first();
        $service->restore();
        return redirect()->back();
    }
}
