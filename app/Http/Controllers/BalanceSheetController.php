<?php

namespace App\Http\Controllers;

use App\Models\Account;

class BalanceSheetController extends Controller
{
    public function index()
    {
        $assets = Account::with('ledgerEntries')
            ->where('account_type', 'Asset')
            ->get();

        $liabilities = Account::with('ledgerEntries')
            ->where('account_type', 'Liability')
            ->get();

        return view('balance-sheet.index', compact(
            'assets',
            'liabilities'
        ));
    }
}