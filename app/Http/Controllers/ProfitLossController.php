<?php

namespace App\Http\Controllers;

use App\Models\Account;

class ProfitLossController extends Controller
{
    public function index()
    {
        $incomeAccounts = Account::with('ledgerEntries')
            ->where('account_type', 'Income')
            ->get();

        $expenseAccounts = Account::with('ledgerEntries')
            ->where('account_type', 'Expense')
            ->get();

        return view('profit-loss.index', compact(
            'incomeAccounts',
            'expenseAccounts'
        ));
    }
}