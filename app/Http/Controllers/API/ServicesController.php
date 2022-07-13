<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Services as ResourcesServices;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class ServicesController extends BaseController
{
    public function index()
    {
        $services = Services::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesServices::collection($services),
            'All Services sent'
        );
    }

    public function servicesTrashed()
    {
        // $services = service::onlyTrashed()->where('user_id', Auth::id())->get();
        $services = Services::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesServices::collection($services),
            'All Services sent'
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
        $photo->move('uploads/services', $newPhoto);

        $service = Services::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/services/' . $newPhoto,
            'slug' =>   str_slug($request->title),
        ]);



        return $this->sendResponse(new ResourcesServices($service), 'Service created successfully');
    }


    public function show($id)
    {
        $service = Services::find($id);
        if (is_null($service)) {
            return $this->sendError('service not found');
        }
        return $this->sendResponse(new ResourcesServices($service), 'Service found successfully');
    }

    public function update(Request $request, Services $service)
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
            $photo->move('uploads/services', $newPhoto);
            $service->photo = 'uploads/services/' . $newPhoto;
        }

        $service->title = $request->title;
        $service->content = $request->content;
        $service->save();

        return $this->sendResponse(new ResourcesServices($service), 'Service updated successfully');
    }


    public function destroy(Services $service)
    {
        $service->delete();
        return $this->sendResponse(new ResourcesServices($service), 'Service deleted successfully');
    }


    public function hdelete(Services $service)
    {
        $service->forceDelete();
        return $this->sendResponse(new ResourcesServices($service), 'Service deleted successfully');
    }

    public function restore($id)
    {
        $service = Services::onlyTrashed()->find($id);
        $service->restore();
        return $this->sendResponse(new ResourcesServices($service), 'Service deleted successfully');
    }
}
