<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client as ResourcesClient;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class ClientController extends BaseController
{
    public function index()
    {
        $clients = Client::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesClient::collection($clients),
            'All Clients sent'
        );
    }

    public function clientsTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $clients = Client::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesClient::collection($clients),
            'All Clients sent'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' =>  'required',
            'photo' =>  'required|image',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/clients', $newPhoto);

        $client = Client::create([
            'user_id' =>  Auth::id(),
            'content' =>   $request->content,
            'photo' =>  'uploads/blogs/' . $newPhoto,
        ]);



        return $this->sendResponse(new ResourcesClient($client), 'Client created successfully');
    }


    public function show($id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
            return $this->sendError('Client not found');
        }
        return $this->sendResponse(new ResourcesClient($client), 'Client found successfully');
    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'content' =>  'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/clients', $newPhoto);
            $client->photo = 'uploads/clients/' . $newPhoto;
        }

        $client->content = $request->content;
        $client->save();

        return $this->sendResponse(new ResourcesClient($client), 'Client updated successfully');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return $this->sendResponse(new ResourcesClient($client), 'Client deleted successfully');
    }


    public function hdelete(Client $client)
    {
        $client->forceDelete();
        return $this->sendResponse(new ResourcesClient($client), 'Client deleted successfully');
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->find($id);
        $client->restore();
        return $this->sendResponse(new ResourcesClient($client), 'Client deleted successfully');
    }
}
