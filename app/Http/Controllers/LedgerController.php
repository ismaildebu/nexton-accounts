<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LedgerEntry;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::all();

        $selectedAccount = null;

        $query = LedgerEntry::with('transaction');

        if ($request->account_id) {

            $query->where('account_id', $request->account_id);

            $selectedAccount = Account::find($request->account_id);
        }


        if ($request->from_date) {
            $query->whereDate('entry_date', '>=', $request->from_date);
        }


        if ($request->to_date) {
            $query->whereDate('entry_date', '<=', $request->to_date);
        }


        $ledger = $query
            ->orderBy('entry_date')
            ->get();


        return view('ledger.index', compact(
            'accounts',
            'ledger',
            'selectedAccount'
        ));
    }
}