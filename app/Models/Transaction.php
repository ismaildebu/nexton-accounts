<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'company_id',
        'account_id',
        'debit_account_id',
        'credit_account_id',
        'transaction_date',
        'voucher_no',
        'transaction_type',
        'amount',
        'description',
        'created_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Legacy
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function debitAccount()
    {
        return $this->belongsTo(Account::class, 'debit_account_id');
    }

    public function creditAccount()
    {
        return $this->belongsTo(Account::class, 'credit_account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }
}