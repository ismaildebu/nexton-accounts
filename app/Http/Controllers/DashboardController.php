<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\LedgerEntry;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = session('company_id');


        // Cash Balance

        $cashAccount = Account::where('company_id', $companyId)
            ->where('account_name', 'LIKE', '%Cash%')
            ->first();


        $cashBalance = 0;


        if ($cashAccount) {

            $debit = LedgerEntry::where('company_id', $companyId)
                ->where('account_id', $cashAccount->id)
                ->sum('debit');


            $credit = LedgerEntry::where('company_id', $companyId)
                ->where('account_id', $cashAccount->id)
                ->sum('credit');


            $cashBalance = $debit - $credit;
        }




        // Bank Balance

        $bankAccount = Account::where('company_id', $companyId)
            ->where('account_name', 'LIKE', '%Bank%')
            ->first();


        $bankBalance = 0;


        if ($bankAccount) {

            $debit = LedgerEntry::where('company_id', $companyId)
                ->where('account_id', $bankAccount->id)
                ->sum('debit');


            $credit = LedgerEntry::where('company_id', $companyId)
                ->where('account_id', $bankAccount->id)
                ->sum('credit');


            $bankBalance = $debit - $credit;
        }




        // Today's Income

        $todayIncome = LedgerEntry::where('company_id', $companyId)
            ->whereDate('entry_date', today())
            ->whereHas('account', function($q){

                $q->where('account_type','Income');

            })
            ->sum('credit');




        // Today's Expense

        $todayExpense = LedgerEntry::where('company_id', $companyId)
            ->whereDate('entry_date', today())
            ->whereHas('account', function($q){

                $q->where('account_type','Expense');

            })
            ->sum('debit');




        return view('dashboard', compact(

            'cashBalance',

            'bankBalance',

            'todayIncome',

            'todayExpense'

        ));
    }
}