<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'company_id',
        'account_code',
        'account_name',
        'account_type',
        'parent_id',
        'opening_balance',
        'balance_type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Parent Account
    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    // Child Accounts
    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    // Legacy Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Debit Transactions
    public function debitTransactions()
    {
        return $this->hasMany(Transaction::class, 'debit_account_id');
    }

    // Credit Transactions
    public function creditTransactions()
    {
        return $this->hasMany(Transaction::class, 'credit_account_id');
    }

    // Ledger Entries
    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }
}