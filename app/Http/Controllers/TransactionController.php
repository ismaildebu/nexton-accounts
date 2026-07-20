<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Company;
use App\Models\Account;
use App\Models\LedgerEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with([
            'company',
            'account',
            'user'
        ])->latest()->paginate(20);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('company_name')->get();
        $accounts  = Account::orderBy('account_code')->get();

        return view('transactions.create', compact(
            'companies',
            'accounts'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id'        => 'required|exists:companies,id',
            'debit_account_id'  => 'required|exists:accounts,id',
            'credit_account_id' => 'required|exists:accounts,id|different:debit_account_id',
            'transaction_date'  => 'required|date',
            'transaction_type'  => 'required|in:Income,Expense,Journal',
            'amount'            => 'required|numeric|min:0.01',
            'description'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $prefix = match ($request->transaction_type) {
                'Income' => 'INC',
                'Expense' => 'EXP',
                default   => 'JV',
            };

            $last = Transaction::latest()->first();

            $next = $last
                ? ((int) substr($last->voucher_no, 4)) + 1
                : 1;

            $voucherNo = $prefix . '-' . str_pad($next, 6, '0', STR_PAD_LEFT);

            $transaction = Transaction::create([
                'company_id'        => $request->company_id,

                // Legacy Field
                'account_id'        => $request->debit_account_id,

                'debit_account_id'  => $request->debit_account_id,
                'credit_account_id' => $request->credit_account_id,

                'transaction_date'  => $request->transaction_date,
                'voucher_no'        => $voucherNo,
                'transaction_type'  => $request->transaction_type,
                'amount'            => $request->amount,
                'description'       => $request->description,
                'created_by'        => Auth::id(),
            ]);

            // Debit Entry
            LedgerEntry::create([
                'transaction_id' => $transaction->id,
                'company_id'     => $request->company_id,
                'account_id'     => $request->debit_account_id,
                'entry_date'     => $request->transaction_date,
                'debit'          => $request->amount,
                'credit'         => 0,
                'description'    => $request->description,
            ]);

            // Credit Entry
            LedgerEntry::create([
                'transaction_id' => $transaction->id,
                'company_id'     => $request->company_id,
                'account_id'     => $request->credit_account_id,
                'entry_date'     => $request->transaction_date,
                'debit'          => 0,
                'credit'         => $request->amount,
                'description'    => $request->description,
            ]);
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction posted successfully.');
    }
        /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $companies = Company::orderBy('company_name')->get();
        $accounts  = Account::orderBy('account_code')->get();

        return view('transactions.edit', compact(
            'transaction',
            'companies',
            'accounts'
        ));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'company_id'        => 'required|exists:companies,id',
            'debit_account_id'  => 'required|exists:accounts,id',
            'credit_account_id' => 'required|exists:accounts,id|different:debit_account_id',
            'transaction_date'  => 'required|date',
            'transaction_type'  => 'required|in:Income,Expense,Journal',
            'amount'            => 'required|numeric|min:0.01',
            'description'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $transaction) {

            // পুরনো Ledger Entry মুছে ফেলুন
            LedgerEntry::where('transaction_id', $transaction->id)->delete();

            // Transaction Update
            $transaction->update([
                'company_id'        => $request->company_id,
                'account_id'        => $request->debit_account_id,
                'debit_account_id'  => $request->debit_account_id,
                'credit_account_id' => $request->credit_account_id,
                'transaction_date'  => $request->transaction_date,
                'transaction_type'  => $request->transaction_type,
                'amount'            => $request->amount,
                'description'       => $request->description,
            ]);

            // Debit Entry
            LedgerEntry::create([
                'transaction_id' => $transaction->id,
                'company_id'     => $request->company_id,
                'account_id'     => $request->debit_account_id,
                'entry_date'     => $request->transaction_date,
                'debit'          => $request->amount,
                'credit'         => 0,
                'description'    => $request->description,
            ]);

            // Credit Entry
            LedgerEntry::create([
                'transaction_id' => $transaction->id,
                'company_id'     => $request->company_id,
                'account_id'     => $request->credit_account_id,
                'entry_date'     => $request->transaction_date,
                'debit'          => 0,
                'credit'         => $request->amount,
                'description'    => $request->description,
            ]);

        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {

            // Delete all related ledger entries
            LedgerEntry::where('transaction_id', $transaction->id)->delete();

            // Delete transaction
            $transaction->delete();

        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}