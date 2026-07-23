<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountTemplate;

class AccountTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [

            // Asset
            [
                'account_code'=>1001,
                'account_name'=>'Cash in Hand',
                'account_type'=>'Asset',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>1002,
                'account_name'=>'Bank Account',
                'account_type'=>'Asset',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>1003,
                'account_name'=>'Accounts Receivable',
                'account_type'=>'Asset',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>1004,
                'account_name'=>'Inventory / Stock',
                'account_type'=>'Asset',
                'balance_type'=>'Debit',
                'industry'=>'Trading'
            ],

            [
                'account_code'=>1005,
                'account_name'=>'Furniture & Equipment',
                'account_type'=>'Asset',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],


            // Expense
            [
                'account_code'=>2001,
                'account_name'=>'Salary Expense',
                'account_type'=>'Expense',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>2002,
                'account_name'=>'Rent Expense',
                'account_type'=>'Expense',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>2003,
                'account_name'=>'Electricity Expense',
                'account_type'=>'Expense',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],

            [
                'account_code'=>2004,
                'account_name'=>'Marketing Expense',
                'account_type'=>'Expense',
                'balance_type'=>'Debit',
                'industry'=>'All'
            ],


            // Liability
            [
                'account_code'=>3001,
                'account_name'=>'Accounts Payable',
                'account_type'=>'Liability',
                'balance_type'=>'Credit',
                'industry'=>'All'
            ],

            [
                'account_code'=>3002,
                'account_name'=>'Loan Payable',
                'account_type'=>'Liability',
                'balance_type'=>'Credit',
                'industry'=>'All'
            ],


            // Equity
            [
                'account_code'=>4001,
                'account_name'=>"Owner's Capital",
                'account_type'=>'Equity',
                'balance_type'=>'Credit',
                'industry'=>'All'
            ],


            // Income
            [
                'account_code'=>5001,
                'account_name'=>'Sales Revenue',
                'account_type'=>'Income',
                'balance_type'=>'Credit',
                'industry'=>'Trading'
            ],

            [
                'account_code'=>5002,
                'account_name'=>'Service Income',
                'account_type'=>'Income',
                'balance_type'=>'Credit',
                'industry'=>'Service'
            ],

        ];


        foreach ($accounts as $account) {

            AccountTemplate::create($account);

        }
    }
}