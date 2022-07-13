<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog as ResourcesBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class BlogController extends BaseController
{
    public function index()
    {
        // $blogs = Blog::selected()->orderBy('id', 'DESC')->skip(($pageNumber - 1) * 6)->take(6)->get();
        $blogs = Blog::selected()->orderBy('id', 'DESC')->get();
        return $this->sendResponse(
            ResourcesBlog::collection($blogs),
            'All Blogs sent'
            // 'All Blogs Page : ' . round(Blog::all()->count() / 6)
        );
    }

    public function blogsTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $blogs = Blog::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesBlog::collection($blogs),
            'All Blogs sent'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required',
            'content' =>  'required',
            'photo' =>  'required|image',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/blogs', $newPhoto);

        $blog = Blog::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/blogs/' . $newPhoto,
            'slug' =>   str_slug($request->title),
        ]);



        return $this->sendResponse(new ResourcesBlog($blog), 'Blog created successfully');
    }


    public function show($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return $this->sendError('Blog not found');
        }
        return $this->sendResponse(new ResourcesBlog($blog), 'Blog found successfully');
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required',
            'content' =>  'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/blogs', $newPhoto);
            $blog->photo = 'uploads/blogs/' . $newPhoto;
        }

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();

        return $this->sendResponse(new ResourcesBlog($blog), 'Blog updated successfully');
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return $this->sendResponse(new ResourcesBlog($blog), 'Blog deleted successfully');
    }


    public function hdelete(Blog $blog)
    {
        $blog->forceDelete();
        return $this->sendResponse(new ResourcesBlog($blog), 'Blog deleted successfully');
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->find($id);
        $blog->restore();
        return $this->sendResponse(new ResourcesBlog($blog), 'Blog deleted successfully');
    }
}
