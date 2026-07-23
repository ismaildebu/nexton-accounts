<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\LedgerEntry;

class DashboardController extends Controller
{
    public function index()
    {

        $companyId = session('company_id');


        if(!$companyId){
            return redirect()
                ->route('companies.index')
                ->with('error','Please select company first.');
        }



        // Cash Account

        $cashAccount = Account::where('company_id',$companyId)
            ->where('account_name','LIKE','%Cash%')
            ->first();



        // Bank Account

        $bankAccount = Account::where('company_id',$companyId)
            ->where('account_name','LIKE','%Bank%')
            ->first();



        $cashBalance = 0;
        $bankBalance = 0;



        if($cashAccount)
        {

            $cashBalance = LedgerEntry::where('company_id',$companyId)
                ->where('account_id',$cashAccount->id)
                ->sum('debit')
                -
                LedgerEntry::where('company_id',$companyId)
                ->where('account_id',$cashAccount->id)
                ->sum('credit');

        }




        if($bankAccount)
        {

            $bankBalance = LedgerEntry::where('company_id',$companyId)
                ->where('account_id',$bankAccount->id)
                ->sum('debit')
                -
                LedgerEntry::where('company_id',$companyId)
                ->where('account_id',$bankAccount->id)
                ->sum('credit');

        }




        // Today's Income

        $todayIncome = LedgerEntry::where('company_id',$companyId)
            ->whereDate('entry_date',today())
            ->where('credit','>',0)
            ->sum('credit');




        // Today's Expense

        $todayExpense = LedgerEntry::where('company_id',$companyId)
            ->whereDate('entry_date',today())
            ->where('debit','>',0)
            ->sum('debit');





        return view('dashboard',compact(

            'cashBalance',
            'bankBalance',
            'todayIncome',
            'todayExpense'

        ));

    }
}