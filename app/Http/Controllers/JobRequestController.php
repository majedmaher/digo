<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requests = JobRequest::orderBy('created_at', 'DESC')->get();
        return view('requests.index')->with('requests', $requests);
    }

    public function contactsTrashed()
    {
        $requests = JobRequest::onlyTrashed()->get();
        return view('requests.trashed')->with('requests', $requests);
    }


    public function destroy($id)
    {
        $contact = JobRequest::find($id);

        $contact->delete($id);
        return redirect()->back();
    }


    public function hdelete($id)
    {
        $contact = JobRequest::withTrashed()->where('id',  $id)->first();
        $contact->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $contact = JobRequest::withTrashed()->where('id',  $id)->first();
        $contact->restore();
        return redirect()->back();
    }
}
