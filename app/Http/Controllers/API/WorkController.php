<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Work as ResourcesWork;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class WorkController extends BaseController
{

    public function index()
    {
        $works = Work::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesWork::collection($works),
            'All Works sent'
        );
    }

    public function worksTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $works = Work::onlyTrashed()->get();
        return $this->sendResponse(
            ResourcesWork::collection($works),
            'All Blogs sent'
        );
    }
    public function create()
    {
        return view('work.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' =>  'required|image',
            'link' =>  'required',
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
            'category' =>   $request->category,
            'is_favorite' => 0,
            'description' => $request->description
        ]);

        return $this->sendResponse(
            ResourcesWork::collection($work),
            'All Work sent'
        );
    }


    public function updateFavorite(Work $work)
    {
        // $work = Work::find($id);
        if (is_null($work)) {
            return $this->sendError('Work not found');
        }

        if ($work->is_favorite == 0) {
            $work->is_favorite = 1;
        } else {
            $work->is_favorite = 0;
        }
        $work->save();
        return $this->sendResponse(
            new ResourcesWork($work),
            'The operation succeeded'
        );
    }


    public function show($id)
    {
        $work = Work::find($id);
        if (is_null($work)) {
            return $this->sendError('Work not found');
        }
        return $this->sendResponse(new ResourcesWork($work), 'Work found successfully');
    }


    public function update(Request $request,  Work $work)
    {
        $this->validate($request, [
            'link' =>  'required',
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
        $work->category = $request->category;
        $work->description = $request->description;
        $work->save();

        return $this->sendResponse(new ResourcesWork($work), 'Work updated successfully');
    }

    public function destroy(Work $work)
    {
        $work->delete();
        return $this->sendResponse(new ResourcesWork($work), 'Work deleted successfully');
    }


    public function hdelete(Work $work)
    {
        $work->forceDelete();
        return $this->sendResponse(new ResourcesWork($work), 'Work deleted successfully');
    }

    public function restore($id)
    {
        $work = Work::onlyTrashed()->find($id);
        $work->restore();
        return $this->sendResponse(new ResourcesWork($work), 'Work deleted successfully');
    }
}
