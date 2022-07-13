<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $works = Work::orderBy('created_at', 'DESC')->get();
        return view('work.index')->with('works', $works);
    }

    public function worksTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $works = Work::onlyTrashed()->get();
        return view('work.trashed')->with('works', $works);
    }
    public function create()
    {
        return view('work.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' =>  'required|image',
            'category' =>  'required',
            'description' => 'required'
        ]);
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/works', $newPhoto);

        $work = Work::create([
            'user_id' =>  Auth::id(),
            'photo' =>  'uploads/works/' . $newPhoto,
            'link' =>   $request->link,
            'behance' =>   $request->link,
            'category' =>   $request->category,
            'is_favorite' => 0,
            'arrangement' => $request->arrangement,
            'description' => $request->description
        ]);

        return redirect()->back();
    }


    public function updateFavorite($id)
    {
        $work = Work::find($id);

        if ($work->is_favorite == 0) {
            $work->is_favorite = 1;
        } else {
            $work->is_favorite = 0;
        }
        $work->save();
        return redirect()->back();
    }


    public function show($id)
    {
        $work = Work::find($id);
        return view('work.show')->with('work', $work);
    }


    public function edit($id)
    {
        $work = Work::find($id);
        if ($work === null) {
            return redirect()->back();
        }
        return view('work.edit')->with('work', $work);
    }

    public function update(Request $request,  $id)
    {
        $work = Work::find($id);
        $this->validate($request, [
            'category' =>  'required',
            'description' => 'required'
        ]);

        //   dd($request->all());

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/works', $newPhoto);
            $work->photo = 'uploads/works/' . $newPhoto;
        }

        $work->link = $request->link;
        $work->behance = $request->behance;
        $work->category = $request->category;
        $work->arrangement = $request->arrangement;
        $work->description = $request->description;
        $work->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //dd($id);
        $work = Work::find($id);

        // $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        // if ($blog === null) {
        //     return redirect()->back();
        // }

        $work->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $work = Work::withTrashed()->where('id',  $id)->first();
        $work->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $work = Work::withTrashed()->where('id',  $id)->first();
        $work->restore();
        return redirect()->back();
    }
}
