<?php

namespace App\Http\Controllers;

use App\Models\MoneyTransfer;
use App\Models\Officer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MoneyTransferController extends Controller
{

    public function print(Request $request)
    {
        $transfers = MoneyTransfer::orderBy('date', 'DESC')->where('officer_id', $request->officer_id)->take($request->movements)->get();
        return view('bank')->with('transfers', $transfers)
            ->with('officer', Officer::find($request->officer_id))
            ->with('movements', count($transfers))
            ->with('date_today', \Carbon\Carbon::now()->format('Y-m-d'));
    }

    public function index($id)
    {
        $transfers = MoneyTransfer::orderBy('date', 'DESC')->where('officer_id', $id)->get();
        return view('transfers.index')->with('transfers', $transfers)
            ->with('officer', Officer::find($id));
    }

    public function transfersTrashed($id)
    {
        $transfers = MoneyTransfer::orderBy('date', 'DESC')->where('officer_id', $id)->get();
        return view('transfers.trashed')->with('transfers', $transfers)
            ->with('officer', Officer::find($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'officer_id' => 'required',
            'date' => 'required|date',

        ]);
        MoneyTransfer::create([
            'amount' =>   $request->amount,
            'officer_id' =>   $request->officer_id,
            'date' =>   $request->date,
            'clarifications' =>   $request->clarifications,
            // 'created_at' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back();
    }


    public function edit($id)
    {
        $transfer = MoneyTransfer::find($id);
        if ($transfer === null) {
            return redirect()->back();
        }
        return view('transfers.edit')->with('transfer', $transfer)
            ->with('officer', Officer::find($transfer->officer_id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
            'officer_id' => 'required',
            'date' => 'required|date'
        ]);
        $transfer = MoneyTransfer::find($id)->update([
            'amount' => $request->amount,
            'officer_id' => $request->officer_id,
            'date' => $request->date,
            'clarifications' => $request->clarifications
        ]);
        return redirect()->route('transfers.show', ['id' => $request->officer_id]);
    }

    public function destroy($id)
    {
        $transfer = MoneyTransfer::find($id)->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $transfer = MoneyTransfer::withTrashed()->where('id',  $id)->first();
        $transfer->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $transfer = MoneyTransfer::withTrashed()->where('id',  $id)->first();
        $transfer->restore();
        return redirect()->back();
    }
}
