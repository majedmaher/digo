<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\MoneyTransferCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MoneyTransferCompanyController extends Controller
{

    public function setFinancialClaim()
    {
        return view('financial_claim.index');
        Carbon::setLocale('ar');
        return \Carbon\Carbon::now()->translatedFormat('l M Y h');
    }

    public function getFinancialClaimsByMonth(Request $request)
    {
        // return \Carbon\Carbon::parse($request->month)->format('Y m');

        $transfers = MoneyTransferCompany::orderBy('date', 'DESC')
            ->whereMonth('month_due', \Carbon\Carbon::parse($request->month)->format('m'))
            ->whereYear('month_due', \Carbon\Carbon::parse($request->month)->format('Y'))->get();
        // return $transfers[0]->company;
        return view('financial_claim.pdf')
            ->with('transfers', $transfers)
            ->with('movements', count($transfers))
            ->with('date_today', \Carbon\Carbon::now()->format('Y-m-d'));
    }

    public function pdf(Request $request)
    {
        $transfers = MoneyTransferCompany::orderBy('date', 'DESC')->where('company_id', $request->company_id)->take($request->movements)->get();
        return view('transfers_company.pdf')->with('transfers', $transfers)
            ->with('company', Company::find($request->company_id))
            ->with('movements', count($transfers))
            ->with('date_today', \Carbon\Carbon::now()->format('Y-m-d'));
    }

    public function index($id)
    {
        $transfers = MoneyTransferCompany::orderBy('date', 'DESC')->where('company_id', $id)->get();
        return view('transfers_company.index')->with('transfers', $transfers)
            ->with('company', Company::find($id));
    }

    public function transfersTrashed($id)
    {
        $transfers = MoneyTransferCompany::orderBy('date', 'DESC')->where('company_id', $id)->get();
        return view('transfers_company.trashed')->with('transfers', $transfers)
            ->with('company', Company::find($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'company_id' => 'required',
            'date' => 'required|date',
            'month_due' => 'required|date',
        ]);

        $transfer = new MoneyTransferCompany();

        if ($request->hasFile('passbook')) {

            $passbook = $request->passbook;
            $newPassbook = time() . $passbook->getClientOriginalName();
            $passbook->move('uploads/money_transfer_company/passbook', $newPassbook);
            $transfer->passbook = 'uploads/money_transfer_company/passbook/' . $newPassbook;
        }
        if ($request->hasFile('financial_claim')) {

            $financial_claim = $request->financial_claim;
            $new_financial_claim = time() . $financial_claim->getClientOriginalName();
            $financial_claim->move('uploads/money_transfer_company/financial_claim', $new_financial_claim);
            $transfer->financial_claim = 'uploads/money_transfer_company/financial_claim/' . $new_financial_claim;
        }
        $transfer->amount = $request->amount;
        $transfer->company_id = $request->company_id;
        $transfer->date = $request->date;
        $transfer->month_due = $request->month_due;
        $transfer->clarifications = $request->clarifications;
        $transfer->save();
        return redirect()->back();
    }


    public function edit($id)
    {
        $transfer = MoneyTransferCompany::find($id);
        if ($transfer === null) {
            return redirect()->back();
        }
        return view('transfers_company.edit')->with('transfer', $transfer)
            ->with('company', Company::find($transfer->company_id));
    }

    public function update(Request $request, $id)
    {

        $transfer = MoneyTransferCompany::where('id', $id)->first();
        $this->validate($request, [
            'amount' => 'required',
            'company_id' => 'required',
            'date' => 'required|date',
            'month_due' => 'required|date',
        ]);

        if ($request->hasFile('passbook')) {

            $passbook = $request->passbook;
            $newPassbook = time() . $passbook->getClientOriginalName();
            $passbook->move('uploads/money_transfer_company/passbook', $newPassbook);
            $transfer->passbook = 'uploads/money_transfer_company/passbook/' . $newPassbook;
        }
        if ($request->hasFile('financial_claim')) {

            $financial_claim = $request->file('financial_claim');
            $new_financial_claim = time() . $financial_claim->getClientOriginalName();
            $financial_claim->move('uploads/money_transfer_company/financial_claim', $new_financial_claim);
            $transfer->financial_claim = 'uploads/money_transfer_company/financial_claim/' . $new_financial_claim;
        }

        $transfer->amount = $request->amount;
        $transfer->company_id = $request->company_id;
        $transfer->date = $request->date;
        $transfer->month_due = $request->month_due . '-01';
        $transfer->clarifications = $request->clarifications;
        $transfer->save();
        return redirect()->route('transfers.company.show', ['id' => $request->company_id]);
    }

    public function destroy($id)
    {
        $transfer = MoneyTransferCompany::find($id)->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $transfer = MoneyTransferCompany::withTrashed()->where('id',  $id)->first();
        $transfer->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $transfer = MoneyTransferCompany::withTrashed()->where('id',  $id)->first();
        $transfer->restore();
        return redirect()->back();
    }
}
