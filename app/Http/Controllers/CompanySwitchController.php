<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanySwitchController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
        ]);


        session([
            'company_id' => $request->company_id
        ]);


        return back()
            ->with('success', 'Company switched successfully.');
    }
}