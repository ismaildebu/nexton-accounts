<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    protected $fillable = [
        'company_id',
        'year_name',
        'start_date',
        'end_date',
        'is_active',
        'is_closed',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}