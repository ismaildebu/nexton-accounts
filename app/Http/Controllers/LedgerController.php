<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LedgerEntry;

class LedgerController extends Controller
{
    public function index(Request $request)
    {

        $companyId = session('company_id');


        // Company wise Accounts

        $accounts = Account::where('company_id', $companyId)
            ->orderBy('account_code')
            ->get();



        $selectedAccount = null;



        // Company wise Ledger

        $query = LedgerEntry::with([
                'transaction',
                'account'
            ])
            ->where('company_id', $companyId);




        // Account Filter

        if ($request->account_id) {


            $query->where(
                'account_id',
                $request->account_id
            );


            $selectedAccount = Account::where('company_id',$companyId)
                ->find($request->account_id);

        }




        // Date Filter

        if ($request->from_date) {

            $query->whereDate(
                'entry_date',
                '>=',
                $request->from_date
            );

        }



        if ($request->to_date) {

            $query->whereDate(
                'entry_date',
                '<=',
                $request->to_date
            );

        }




        $ledger = $query
            ->orderBy('entry_date')
            ->orderBy('id')
            ->get();




        return view('ledger.index', compact(
            'accounts',
            'ledger',
            'selectedAccount'
        ));

    }
}