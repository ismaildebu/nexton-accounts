<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $cashAccount = Account::where('account_name', 'Cash')->first();
        $bankAccount = Account::where('account_name', 'Bank')->first();

        $cashBalance = 0;
        $bankBalance = 0;

        if ($cashAccount) {
            $cashBalance = Transaction::where('account_id', $cashAccount->id)->sum('amount');
        }

        if ($bankAccount) {
            $bankBalance = Transaction::where('account_id', $bankAccount->id)->sum('amount');
        }

        $todayIncome = Transaction::whereDate('transaction_date', today())
            ->where('transaction_type', 'Income')
            ->sum('amount');

        $todayExpense = Transaction::whereDate('transaction_date', today())
            ->where('transaction_type', 'Expense')
            ->sum('amount');

        return view('dashboard', compact(
            'cashBalance',
            'bankBalance',
            'todayIncome',
            'todayExpense'
        ));
    }
}