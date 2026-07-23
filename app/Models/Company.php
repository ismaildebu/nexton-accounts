<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'owner_name',
        'email',
        'phone',
        'logo',
        'address',
        'city',
        'country',
        'currency',
        'currency_symbol',
        'financial_year',
        'status',
        'business_type',
    ];


    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }
}