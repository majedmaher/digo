<?php

namespace App\Http\Controllers;

use App\Events\MyNotification;
use App\Models\Blog;
use App\Models\FcmToken;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();

        return view('blog.index')->with('blogs', $blogs);
    }

    public function blogsTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        if (Auth::user()->is_admin == 1) {
            $blogs = Blog::onlyTrashed()->get();
        } else {
            $blogs = Blog::onlyTrashed()->where('user_id',  Auth::id())->get();
        }
        return view('blog.trashed')->with('blogs', $blogs);
    }
    public function create()
    {
        return view('blog.create');
    }

    public function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
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
        $newPhoto = $photo->getClientOriginalName();
        $photo->move('uploads/blogs', $newPhoto);


        $blog = Blog::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/blogs/' . $newPhoto,
            // 'slug' => $this->slug($request->title),
            // 'slug' => str_slug($request->title),
            'slug' => str_replace(' ', '-', $request->title),
            'description' =>  $request->description,
            'keywords' =>  str_replace('،', ',', $request->keywords),
        ]);
        $tokens = FcmToken::selected()->all();
        // return $tokens;
        // $tokens = array("dgbD-SBz5xtQczZaPxDC9u:APA91bHBsca6883j-PD1HJD5vELOovHL4jkuB1Eqr0kDQ06JgeshYDIt8OkIwNElD3bEPm0rwI48XIqTAxU1kUKXcgHSS0c5EOLRdl2W3j9j2gY5F2anXQ3v57k7lLkv3VTMgpiDUKzm");
        $notification = [
            'id' => $blog->id,
            'title' => $blog->title,
            'body' => $blog->content
        ];
        FCMService::send(
            $tokens,
            $notification
        );
        return back()->with('success', 'Notification send successfully.');

        // dd($blog);
    }
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        return view('blog.show')->with('blog', $blog);
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
        return view('blog.edit')->with('blog', $blog);
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
            $newPhoto = $photo->getClientOriginalName();
            $photo->move('uploads/blogs', $newPhoto);
            $blog->photo = 'uploads/blogs/' . $newPhoto;
        }

        $blog->title = $request->title;
        // $blog->slug = $this->slug($request->title);
        // $blog->slug = str_slug($request->title);
        $blog->slug = str_replace(' ', '-', $request->title);
        $blog->content = $request->content;
        $blog->description = $request->description;
        $blog->keywords = str_replace('،', ',', $request->keywords);
        $blog->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //dd($id);
        if (Auth::user()->is_admin == 1) {
            $blog = Blog::find($id);
        } else {
            $blog = Blog::find($id)->where('user_id',  Auth::id())->first();
        }
        if ($blog === null) {
            return redirect()->back();
        }
        // $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        // if ($blog === null) {
        //     return redirect()->back();
        // }

        $blog->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        if (Auth::user()->is_admin == 1) {
            $blog = Blog::withTrashed()->where('id',  $id)->first();
        } else {
            $blog = Blog::withTrashed()->where('id',  $id)->where('user_id',  Auth::id())->first();
        }
        if ($blog === null) {
            return redirect()->back();
        }
        $blog->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        if (Auth::user()->is_admin == 1) {
            $blog = Blog::withTrashed()->where('id',  $id)->first();
        } else {
            $blog = Blog::withTrashed()->where('id',  $id)->where('user_id',  Auth::id())->first();
        }
        if ($blog === null) {
            return redirect()->back();
        }
        $blog->restore();
        return redirect()->back();
    }

    // public function updateSlugs()
    // {
    //     $blogs = Blog::all();
    //     foreach ($blogs as $blog) {
    //         $blog->slug = $this->slug($blog->title);
    //         $blog->save();
    //     }
    //     return 'success';
    // }
}
