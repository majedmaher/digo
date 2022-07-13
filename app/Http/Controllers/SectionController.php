<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('created_at', 'DESC')->get();
        return view('sections.index')->with('sections', $sections);
    }

    public function sectionsTrashed()
    {
        $sections = Section::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('sections.trashed')->with('sections', $sections);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Section::create([
            'name' =>  $request->name,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $section = Section::find($id)->update([
            'name' =>  $request->name,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $section = Section::find($id)->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $section = Section::withTrashed()->where('id',  $id)->first();
        $section->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $section = Section::withTrashed()->where('id',  $id)->first();
        $section->restore();
        return redirect()->back();
    }
}
