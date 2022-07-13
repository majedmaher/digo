<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Contact as ResourcesContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class ContactController extends BaseController
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesContact::collection($contacts),
            'All Contacts sent'
        );
    }

    public function contactsTrashed()
    {
        // $blogs = Blog::onlyTrashed()->where('user_id', Auth::id())->get();
        $contacts = Contact::onlyTrashed()->get();

        return $this->sendResponse(
            ResourcesContact::collection($contacts),
            'All Contacts sent'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>   $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }

        $contact = Contact::create([
            'user_id' =>  Auth::id(),
            'name' =>   $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        return $this->sendResponse(new ResourcesContact($contact), 'Contact created successfully');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse(new ResourcesContact($contact), 'Contact deleted successfully');
    }


    public function hdelete(Contact $contact)
    {
        $contact->forceDelete();
        return $this->sendResponse(new ResourcesContact($contact), 'Contact deleted successfully');
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->find($id);
        $contact->restore();
        return $this->sendResponse(new ResourcesContact($contact), 'Contact deleted successfully');
    }
}
