<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return view('contact.index')->with('contacts', $contacts);
    }

    public function contactsTrashed()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('contact.trashed')->with('contacts', $contacts);
    }


    public function destroy($id)
    {
        $contact = Contact::find($id);

        $contact->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $contact = Contact::withTrashed()->where('id',  $id)->first();
        $contact->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $contact = Contact::withTrashed()->where('id',  $id)->first();
        $contact->restore();
        return redirect()->back();
    }
}
