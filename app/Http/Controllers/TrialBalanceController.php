<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class TrialBalanceController extends Controller
{
    public function index()
    {
        $accounts = Account::with('ledgerEntries')->get();

        return view('trial-balance.index', compact('accounts'));
    }
}