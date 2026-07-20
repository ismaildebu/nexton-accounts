<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    protected $fillable = [
        'transaction_id',
        'company_id',
        'account_id',
        'entry_date',
        'debit',
        'credit',
        'description',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}