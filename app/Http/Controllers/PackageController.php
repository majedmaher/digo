<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;

class PackageController extends Controller
{
    public function index()
    {
        // return Currency::convert()
        //     ->from('sar')
        //     ->to('ils')
        //     ->amount(100)
        //     // ->round(2)
        //     ->get();
        $packages = Package::getData()->latest()->get();
        return view('packages.index')->with('packages', $packages);
    }

    public function create()
    {
        return view('packages.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'period' => 'required',
            'currencyـname' => 'required',
            'currencyـabbreviation' => 'required',
        ]);

        Package::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'period' => $request->period,
            'currencyـname' => $request->currencyـname,
            'currencyـabbreviation' => $request->currencyـabbreviation,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('packages.index');
    }

    public function edit($id)
    {
        $package = Package::find($id);
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'period' => 'required',
            'currencyـname' => 'required',
            'currencyـabbreviation' => 'required',
        ]);

        Package::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'period' => $request->period,
            'currencyـname' => $request->currencyـname,
            'currencyـabbreviation' => $request->currencyـabbreviation,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('packages.index');
    }

    public function destroy($id)
    {
        Package::destroy($id);
        return redirect()->route('packages.index');
    }
}
