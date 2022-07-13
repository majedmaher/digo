<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{

    public function index()
    {
        $officers = Officer::orderBy('status', 'DESC')->get();
        return view('officers.index')->with('officers', $officers);
    }

    public function officersTrashed()
    {
        $officers = Officer::onlyTrashed()->orderBy('status', 'DESC')->get();
        return view('officers.trashed')->with('officers', $officers);
    }

    public function create()
    {
        return view('officers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $status = 1;
        if (!isset($request->status)) {
            $status = 0;
        }

        Officer::create([
            'name' =>  $request->name,
            'id_number' =>  $request->id_number,
            'salary' =>   $request->salary,
            'address' =>   $request->address,
            'email' =>   $request->email,
            'phone_number' =>   $request->phone_number,
            'status' =>   $status,
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $officer = Officer::find($id);
        if ($officer === null) {
            return redirect()->back();
        }
        return view('officers.edit')->with('officer', $officer);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $status = 1;
        if (!isset($request->status)) {
            $status = 0;
        }

        $officer = Officer::find($id)->update([
            'name' =>  $request->name,
            'id_number' =>  $request->id_number,
            'salary' =>   $request->salary,
            'address' =>   $request->address,
            'email' =>   $request->email,
            'phone_number' =>   $request->phone_number,
            'status' =>   $status,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $officer = Officer::find($id)->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $officer = Officer::withTrashed()->where('id',  $id)->first();
        $officer->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $officer = Officer::withTrashed()->where('id',  $id)->first();
        $officer->restore();
        return redirect()->back();
    }
}
