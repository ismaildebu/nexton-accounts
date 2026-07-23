<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountTemplate extends Model
{
    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'balance_type',
        'industry',
    ];
}