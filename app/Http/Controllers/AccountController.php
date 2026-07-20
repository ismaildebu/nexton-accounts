<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Company;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of accounts.
     */
    public function index()
    {
        $accounts = Account::with('company')
            ->latest()
            ->get();

        return view('accounts.index', compact('accounts'));
    }


    /**
     * Show create account form.
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
     * Store new account.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'account_name' => 'required',
            'account_type' => 'required',
        ]);


        Account::create([
            'company_id' => $request->company_id,
            'account_code' => $request->account_code,
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


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}