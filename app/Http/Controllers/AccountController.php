<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Company;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Generate Automatic Account Code
     */
    private function generateAccountCode($type)
    {
        $prefix = [
            'Asset'     => 1000,
            'Expense'   => 2000,
            'Liability' => 3000,
            'Equity'    => 4000,
            'Income'    => 5000,
        ];


        $lastAccount = Account::where('account_type', $type)
            ->orderBy('account_code', 'desc')
            ->first();


        if ($lastAccount) {
            return $lastAccount->account_code + 1;
        }


        return $prefix[$type] + 1;
    }



    /**
     * Display accounts
     */
    public function index()
{
    $companyId = session('company_id');


    $accounts = Account::with('company')
        ->where('company_id', $companyId)
        ->latest()
        ->get();


    return view('accounts.index', compact('accounts'));
}


    /**
     * Create Account Form
     */
    public function create()
    {
        $companies = Company::all();

        $parentAccounts = Account::all();

        return view('accounts.create', compact(
            'companies',
            'parentAccounts'
        ));
    }



    /**
     * Store Account
     */
    public function store(Request $request)
    {

        $request->validate([
            'company_id'      => 'required|exists:companies,id',
            'account_name'    => 'required|max:255',
            'account_type'    => 'required|in:Asset,Liability,Equity,Income,Expense',
            'opening_balance' => 'nullable|numeric|min:0',
            'balance_type'    => 'required|in:Debit,Credit',
        ]);



        Account::create([

            'company_id' => $request->company_id,

            // Auto Generated Code
            'account_code' => $this->generateAccountCode(
                $request->account_type
            ),

            'account_name' => $request->account_name,

            'account_type' => $request->account_type,

            'parent_id' => $request->parent_id,

            'opening_balance' => $request->opening_balance ?? 0,

            'balance_type' => $request->balance_type ?? 'Debit',

        ]);



        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account created successfully.');
    }




    /**
     * Edit Account
     */
    public function edit(string $id)
    {
        $account = Account::findOrFail($id);

        $companies = Company::all();

        $parentAccounts = Account::where('id','!=',$id)->get();


        return view('accounts.edit', compact(
            'account',
            'companies',
            'parentAccounts'
        ));
    }




    /**
     * Show Account
     */
    public function show(string $id)
    {
        $account = Account::findOrFail($id);

        return view('accounts.show', compact('account'));
    }




    /**
     * Update Account
     */
    public function update(Request $request, string $id)
    {

        $request->validate([

            'company_id'      => 'required|exists:companies,id',

            'account_name'    => 'required|max:255',

            'account_type'    => 'required|in:Asset,Liability,Equity,Income,Expense',

            'opening_balance' => 'nullable|numeric|min:0',

            'balance_type'    => 'required|in:Debit,Credit',

        ]);



        $account = Account::findOrFail($id);



        $account->update([

            'company_id' => $request->company_id,

            // Existing code থাকবে
            'account_code' => $account->account_code,

            'account_name' => $request->account_name,

            'account_type' => $request->account_type,

            'parent_id' => $request->parent_id,

            'opening_balance' => $request->opening_balance ?? 0,

            'balance_type' => $request->balance_type ?? 'Debit',

        ]);



        return redirect()
            ->route('accounts.index')
            ->with('success','Account updated successfully.');
    }





    /**
     * Delete Account
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);

        $account->delete();


        return redirect()
            ->route('accounts.index')
            ->with('success','Account deleted successfully.');
    }

}