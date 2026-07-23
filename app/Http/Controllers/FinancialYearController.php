<?php
namespace App\Http\Controllers;

use App\Models\FinancialYear;
use App\Models\Company;
use Illuminate\Http\Request;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
{
    $financialYears = \App\Models\FinancialYear::with('company')
        ->latest()
        ->get();

    return view('financial-years.index', compact('financialYears'));
}

    /**
     * Show the form for creating a new resource.
     */
   
    public function create()
{
    $companies = \App\Models\Company::all();

    return view('financial-years.create', compact('companies'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'company_id' => 'required',
        'year_name'  => 'required|unique:financial_years,year_name',
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after:start_date',
    ]);

    \App\Models\FinancialYear::create([
        'company_id' => $request->company_id,
        'year_name'  => $request->year_name,
        'start_date' => $request->start_date,
        'end_date'   => $request->end_date,
        'is_active'  => $request->is_active ?? 0,
        'is_closed'  => $request->is_closed ?? 0,
    ]);

    return redirect()
        ->route('financial-years.index')
        ->with('success', 'Financial Year created successfully.');
}
    

    /**
     * Display the specified resource.
     */
   
    public function show(string $id)
{
    $financialYear = \App\Models\FinancialYear::findOrFail($id);

    return view('financial-years.show', compact('financialYear'));
}

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit(string $id)
{
    $financialYear = \App\Models\FinancialYear::findOrFail($id);

    $companies = \App\Models\Company::all();

    return view('financial-years.edit', compact(
        'financialYear',
        'companies'
    ));
}

    /**
     * Update the specified resource in storage.
     */
  
    public function update(Request $request, string $id)
{
    $request->validate([
        'company_id' => 'required',
        'year_name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
    ]);


    $financialYear = FinancialYear::findOrFail($id);


    $financialYear->update([
        'company_id' => $request->company_id,
        'year_name' => $request->year_name,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'is_active' => $request->is_active ?? 0,
        'is_closed' => $request->is_closed ?? 0,
    ]);


    return redirect()
        ->route('financial-years.index')
        ->with('success', 'Financial Year updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $financialYear = FinancialYear::findOrFail($id);

    $financialYear->delete();

    return redirect()
        ->route('financial-years.index')
        ->with('success', 'Financial Year deleted successfully.');
}
    
}
