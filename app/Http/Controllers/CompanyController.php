<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function index()
    {
        $companys = Company::with(['transfers' => function ($query) {
            $query->groupBy('company_id')->select('company_id', DB::raw('SUM(amount) AS amount_sum'));
        }])->orderBy('status', 'DESC')->get();
        return view('companys.index')->with('companys', $companys);
    }

    public function companysTrashed()
    {
        $companys = Company::onlyTrashed()->orderBy('status', 'DESC')->get();
        return view('companys.trashed')->with('companys', $companys);
    }

    public function create()
    {
        $sections = Section::orderBy('created_at', 'DESC')->get();
        return view('companys.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
        ]);
        $company = new Company();
        $status = 1;
        if (!isset($request->status)) {
            $status = 0;
        }
        if ($request->hasFile('companyـcontract')) {
            $companyـcontract = $request->file('companyـcontract');
            $new_companyـcontract = time() . $companyـcontract->getClientOriginalName();
            $companyـcontract->move('uploads/companies/company_contract', $new_companyـcontract);
            $company->companyـcontract = 'uploads/companies/company_contract/' . $new_companyـcontract;
        }
        $company->company_name =  $request->company_name;
        $company->companyـofficial_name =   $request->companyـofficial_name;
        $company->commercial_registration_no =   $request->commercial_registration_no;
        $company->address =   $request->address;
        $company->status =   $status;
        $company->start_decade =   $request->start_decade;
        $company->end_decade =   $request->end_decade;
        $company->save();

        $company->sections()->attach($request->sections);
        return redirect()->back();
    }

    public function edit($id)
    {
        $company = Company::find($id);
        if ($company === null) {
            return redirect()->back();
        }
        return view('companys.edit')->with('company', $company)
            ->with('sections', Section::orderBy('created_at', 'DESC')->get());
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name' => 'required',
        ]);
        $company = Company::find($id);
        $status = 1;
        if (!isset($request->status)) {
            $status = 0;
        }
        if ($request->hasFile('companyـcontract')) {
            $companyـcontract = $request->file('companyـcontract');
            $new_companyـcontract = time() . $companyـcontract->getClientOriginalName();
            $companyـcontract->move('uploads/companies/company_contract', $new_companyـcontract);
            $company->companyـcontract = 'uploads/companies/company_contract/' . $new_companyـcontract;
        }
        $company->company_name =  $request->company_name;
        $company->companyـofficial_name =   $request->companyـofficial_name;
        $company->commercial_registration_no =   $request->commercial_registration_no;
        $company->address =   $request->address;
        $company->status =   $status;
        $company->start_decade =   $request->start_decade;
        $company->end_decade =   $request->end_decade;
        $company->save();

        $company->sections()->sync($request->sections);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $company = Company::find($id)->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $company = Company::withTrashed()->where('id',  $id)->first();
        $company->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $company = Company::withTrashed()->where('id',  $id)->first();
        $company->restore();
        return redirect()->back();
    }
}
