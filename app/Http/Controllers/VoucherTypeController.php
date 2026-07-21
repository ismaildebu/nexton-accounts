<?php

namespace App\Http\Controllers;

use App\Models\VoucherType;
use App\Models\Company;
use Illuminate\Http\Request;


class VoucherTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
{
    $voucherTypes = VoucherType::with('company')
        ->latest()
        ->get();

    return view('voucher-types.index', compact('voucherTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
   
    public function create()
{
    $companies = Company::all();

    return view('voucher-types.create', compact('companies'));
}

    /**
     * Store a newly created resource in storage.
     */
  
    public function store(Request $request)
{
    $request->validate([
        'company_id'   => 'required',
        'voucher_name' => 'required',
        'voucher_code' => 'required|unique:voucher_types,voucher_code',
    ]);

    VoucherType::create([
        'company_id'   => $request->company_id,
        'voucher_name' => $request->voucher_name,
        'voucher_code' => strtoupper($request->voucher_code),
        'is_active'    => $request->has('is_active'),
    ]);

    return redirect()
        ->route('voucher-types.index')
        ->with('success', 'Voucher Type created successfully.');
}

    /**
     * Display the specified resource.
     */
   
    public function show(string $id)
{
    $voucherType = VoucherType::with('company')->findOrFail($id);

    return view('voucher-types.show', compact('voucherType'));
}

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit(string $id)
{
    $voucherType = VoucherType::findOrFail($id);

    $companies = Company::all();

    return view('voucher-types.edit', compact(
        'voucherType',
        'companies'
    ));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $request->validate([
        'company_id'   => 'required',
        'voucher_name' => 'required',
        'voucher_code' => 'required|unique:voucher_types,voucher_code,' . $id,
    ]);

    $voucherType = VoucherType::findOrFail($id);

    $voucherType->update([
        'company_id'   => $request->company_id,
        'voucher_name' => $request->voucher_name,
        'voucher_code' => strtoupper($request->voucher_code),
        'is_active'    => $request->has('is_active'),
    ]);

    return redirect()
        ->route('voucher-types.index')
        ->with('success', 'Voucher Type updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   
    public function destroy(string $id)
{
    $voucherType = VoucherType::findOrFail($id);

    $voucherType->delete();

    return redirect()
        ->route('voucher-types.index')
        ->with('success', 'Voucher Type deleted successfully.');
}
}
