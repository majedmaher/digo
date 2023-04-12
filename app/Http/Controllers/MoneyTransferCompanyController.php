<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\MoneyTransferCompany;
use App\Models\Tax;
use App\Models\TaxItem;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MoneyTransferCompanyController extends Controller
{

    public function taxInvoiceindex($id)
    {
        $tax = Tax::latest()->where('company_id', $id)->get();
        return view('financial_claim.tax-invoice-index')->with('company', Company::find($id))
            ->with('tax', $tax);
    }

    public function taxInvoiceStore(Request $request)
    {
        if ((isset($request->price[0]) && $request->price[0] != null) || (isset($request->price[1]) && $request->price[1] != null)) {
            $tax = Tax::create([
                'invoice_no' => uniqid(),
                'company_id' => $request->company_id,
                'invoice_date' => $request->date
            ]);

            $items = [];
            $i = 0;
            foreach ($request->description as $value) {
                $items[$i]['tax_id'] = $tax->id;
                $items[$i]['description'] = $value;
                $i++;
            }
            $i = 0;
            foreach ($request->quantity as $value) {
                $items[$i]['quantity'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->price as $value) {
                $items[$i]['price'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->tax_rate as $value) {
                $items[$i]['tax_rate'] = $value != null ? (int) $value : (int)'15';
                $i++;
            }
            $i = 0;
            foreach ($items as $value) {
                $total = $items[$i]['quantity'] * $items[$i]['price'];
                $items[$i]['total_price'] = $total;
                $items[$i]['tax_amount'] = $total *  ($items[$i]['tax_rate'] / 100);
                TaxItem::create($items[$i]);
                $i++;
            }
        }
        return back();
    }

    public function taxInvoiceEdit($id)
    {
        $tax = Tax::with('taxes', 'company')->get()->find($id);
        return view('financial_claim.tax-invoice-edit', compact('tax'));
    }

    public function taxInvoiceUpdate($id, Request $request)
    {
        Tax::find($id)->update([
            'invoice_date' => $request->date
        ]);
        if ((isset($request->price[0]) && $request->price[0] != null) || (isset($request->price[1]) && $request->price[1] != null)) {

            $items = [];
            $i = 0;
            foreach ($request->description as $value) {
                $items[$i]['tax_id'] = $id;
                $items[$i]['description'] = $value;
                $i++;
            }
            $i = 0;
            foreach ($request->quantity as $value) {
                $items[$i]['quantity'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->price as $value) {
                $items[$i]['price'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->tax_rate as $value) {
                $items[$i]['tax_rate'] = $value != null ? (int) $value : (int)'15';
                $i++;
            }
            $i = 0;
            foreach ($items as $value) {
                $total = $items[$i]['quantity'] * $items[$i]['price'];
                $items[$i]['total_price'] = $total;
                $items[$i]['tax_amount'] = $total *  ($items[$i]['tax_rate'] / 100);
                TaxItem::create($items[$i]);
                $i++;
            }
        }
        return back();
    }

    public function taxInvoiceDeleteGet($id)
    {
        Tax::find($id)->delete();
        return back();
    }

    public function taxInvoiceDelete(Request $request)
    {
        TaxItem::find($request->id)->delete();
        return response()->json(['status' => 'success', 'message' => 'item deleted successfully']);
    }

    public function taxItemUpdate(Request $request)
    {
        $total = $request->price * $request->quantity;
        TaxItem::find($request->id)->update([
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_price' => $total,
            'tax_rate' => $request->tax_rate != null ? (int) $request->tax_rate : (int)'15',
            'tax_amount' => $total *  ($request->tax_rate / 100),
        ]);

        $tax_item = TaxItem::find($request->id);

        $amount = 0;
        $taxes = $tax_item->tax->taxes;
        foreach ($taxes as $tax) {
            $amount += $tax->total_price;
        }
        $t = $tax_item->tax->moneyTransferCompany;
        $t->amount = $amount;
        $t->update();

        return response()->json(['status' => 'success', 'message' => 'item deleted successfully']);
    }

    public function taxInvoice($id)
    {
        $tax = Tax::with('taxes', 'company')->get()->find($id);
        $today = Carbon::today()->format('Y-m-d');
        // $pdf = PDF::loadView('financial_claim.tax-invoice', compact('tax', 'today'));
        // $pdf->setOptions([
        //     'defaultPaperSize' => 'a4',
        // ]);
        // return $pdf->download('invoice.pdf');
        return view('financial_claim.tax-invoice', compact('tax', 'today'));
    }

    public function taxInvoiceCompany(Request $request, $id)
    {
        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        // $tax = MoneyTransferCompany::where('company_id')->whereBetween('date')->get();
        $company = Company::where('id', $id)->with('transfers', function ($query) {
            return $query->whereBetween('date', ['2010-07-01', '2024-09-01'])->with('tax.taxes');
            // return $query;
        })->first();
        // return $company->transfers[27]->tax->taxes;
        $today = Carbon::today()->format('Y-m-d');
        return view('financial_claim.tax-invoice-company', compact('company', 'today'));
    }

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
        // $aa = MoneyTransferCompany::where('id', 159)->with('tax', function ($query) {
        //     return $query->with('taxes');
        // })->get();
        // return $aa[0]->tax->taxes;
        // $transfers = MoneyTransferCompany::orderBy('month_due', 'DESC')->where('company_id', $id)->with('tax', function ($query) {
        //     return $query->where('company_id', '=', null);
        // })->get();
        $transfers = MoneyTransferCompany::orderBy('month_due', 'DESC')->where('company_id', $id)->with('tax')->get();
        // return $transfers;
        return view('transfers_company.index')->with('transfers', $transfers)
            ->with('company', Company::find($id))
            ->with('taxes', Tax::latest()->where('company_id', $id)->whereNull('money_transfer_company_id')->get());
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
            // 'amount' => 'required',
            'company_id' => 'required',
            'date' => 'required|date',
            // 'month_due' => 'required|date',
        ]);

        $amount = 0;
        $tax = new Tax();
        if ((isset($request->price[0]) && $request->price[0] != null) || (isset($request->price[1]) && $request->price[1] != null)) {

            $tax->invoice_no = uniqid();
            $tax->company_id = $request->company_id;
            $tax->invoice_date = $request->date;
            $tax->save();

            $items = [];
            $i = 0;
            foreach ($request->description as $value) {
                $items[$i]['tax_id'] = $tax->id;
                $items[$i]['description'] = $value;
                $i++;
            }
            $i = 0;
            foreach ($request->quantity as $value) {
                $items[$i]['quantity'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->price as $value) {
                $items[$i]['price'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->tax_rate as $value) {
                $items[$i]['tax_rate'] = $value != null ? (int) $value : (int)'15';
                $i++;
            }
            $i = 0;
            foreach ($items as $value) {
                $total = $items[$i]['quantity'] * $items[$i]['price'];
                $items[$i]['total_price'] = $total;
                $items[$i]['tax_amount'] = $total *  ($items[$i]['tax_rate'] / 100);
                TaxItem::create($items[$i]);
                $amount += $total;
                $i++;
            }
        }

        $transfer = new MoneyTransferCompany();

        if ($request->hasFile('passbook')) {

            $passbook = $request->passbook;
            $newPassbook = time() . $passbook->getClientOriginalName();
            $passbook->move('uploads/money_transfer_company/passbook', $newPassbook);
            $transfer->passbook = 'uploads/money_transfer_company/passbook/' . $newPassbook;
        }

        // if ($request->hasFile('financial_claim')) {

        //     $financial_claim = $request->financial_claim;
        //     $new_financial_claim = time() . $financial_claim->getClientOriginalName();
        //     $financial_claim->move('uploads/money_transfer_company/financial_claim', $new_financial_claim);
        //     $transfer->financial_claim = 'uploads/money_transfer_company/financial_claim/' . $new_financial_claim;
        // }
        // $transfer->amount = $request->amount;
        $transfer->amount = $amount;
        $transfer->company_id = $request->company_id;
        $transfer->date = $request->date;
        $transfer->month_due = $request->date;
        $transfer->clarifications = $request->clarifications;
        $transfer->status = $request->status;
        $transfer->save();

        $tax->money_transfer_company_id = $transfer->id;
        $tax->update();
        // Tax::find($request->tax_id)->update([
        //     'money_transfer_company_id' => $transfer->id
        // ]);

        return redirect()->back();
    }


    public function edit($id)
    {
        $transfer = MoneyTransferCompany::with('tax.taxes')->get()->find($id);
        // return $transfer;
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
            // 'amount' => 'required',
            'company_id' => 'required',
            'date' => 'required|date',
            // 'month_due' => 'required|date',
        ]);

        if ((isset($request->price[0]) && $request->price[0] != null) || (isset($request->price[1]) && $request->price[1] != null)) {

            $tax_id = null;
            if (isset($transfer->tax)) {
                $tax_id = $transfer->tax->id;
            } else {
                $tax = new Tax();
                $tax->invoice_no = uniqid();
                $tax->company_id = $request->company_id;
                $tax->invoice_date = $request->date;
                $tax->save();
                $tax_id = $tax->id;
            }

            $items = [];
            $i = 0;
            foreach ($request->description as $value) {
                $items[$i]['tax_id'] = $tax_id;
                $items[$i]['description'] = $value;
                $i++;
            }
            $i = 0;
            foreach ($request->quantity as $value) {
                $items[$i]['quantity'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->price as $value) {
                $items[$i]['price'] = (int) $value;
                $i++;
            }
            $i = 0;
            foreach ($request->tax_rate as $value) {
                $items[$i]['tax_rate'] = $value != null ? (int) $value : (int)'15';
                $i++;
            }
            $i = 0;
            foreach ($items as $value) {
                $total = $items[$i]['quantity'] * $items[$i]['price'];
                $items[$i]['total_price'] = $total;
                $items[$i]['tax_amount'] = $total *  ($items[$i]['tax_rate'] / 100);
                TaxItem::create($items[$i]);
                $i++;
            }
        }


        if ($request->hasFile('passbook')) {

            $passbook = $request->passbook;
            $newPassbook = time() . $passbook->getClientOriginalName();
            $passbook->move('uploads/money_transfer_company/passbook', $newPassbook);
            $transfer->passbook = 'uploads/money_transfer_company/passbook/' . $newPassbook;
        }
        // if ($request->hasFile('financial_claim')) {

        //     $financial_claim = $request->file('financial_claim');
        //     $new_financial_claim = time() . $financial_claim->getClientOriginalName();
        //     $financial_claim->move('uploads/money_transfer_company/financial_claim', $new_financial_claim);
        //     $transfer->financial_claim = 'uploads/money_transfer_company/financial_claim/' . $new_financial_claim;
        // }

        $transfer->company_id = $request->company_id;
        $transfer->date = $request->date;
        $transfer->month_due = $request->date;
        $transfer->clarifications = $request->clarifications;
        $transfer->status = $request->status;

        $amount = 0;
        $taxes = $transfer->tax->taxes;
        foreach ($taxes as $tax) {
            $amount += $tax->total_price;
        }
        $transfer->amount = $amount;
        $transfer->update();

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
