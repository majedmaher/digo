<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();

        return view('guest_blog.index')->with('blogs', $blogs);
    }

    public function create()
    {
        return view('guest_blog.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'content' =>  'required',
            'photo' =>  'required|image',
            'description' =>  'required',
            'keywords' =>  'required',
        ]);
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/blogs', $newPhoto);

        $blog = Blog::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/blogs/' . $newPhoto,
            'slug' =>   str_slug($request->title),
            'description' =>  $request->description,
            'keywords' =>  $request->keywords,
        ]);

        // dd($blog);
        return redirect()->back();
    }
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        return view('guest_blog.show')->with('blog', $blog);
    }


    public function edit($slug)
    {
        if (Auth::user()->is_admin == 1) {
            $blog = Blog::where('slug', $slug)->first();
        } else {
            $blog = Blog::where('slug', $slug)->where('user_id',  Auth::id())->first();
        }
        if ($blog === null) {
            return redirect()->back();
        }
        return view('guest_blog.edit')->with('blog', $blog);
    }

    public function update(Request $request,  $slug)
    {
        if (Auth::user()->is_admin == 1) {
            $blog = Blog::where('slug', $slug)->first();
        } else {
            $blog = Blog::where('slug', $slug)->where('user_id',  Auth::id())->first();
        }
        if ($blog === null) {
            return redirect()->back();
        }
        $this->validate($request, [
            'title' =>  'required',
            'content' =>  'required',
            'description' =>  'required',
            'keywords' =>  'required'
        ]);

        //   dd($request->all());

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/blogs', $newPhoto);
            $blog->photo = 'uploads/blogs/' . $newPhoto;
        }

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->description = $request->description;
        $blog->keywords = $request->keywords;
        $blog->save();
        return redirect()->back();
    }
}
