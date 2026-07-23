<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Account;
use App\Models\AccountTemplate;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /**
     * Company List
     */
    public function index()
    {
        $companies = Company::latest()->get();

        return view('companies.index', compact('companies'));
    }



    /**
     * Create Company Form
     */
    public function create()
    {
        $accountTemplates = AccountTemplate::orderBy('account_code')
            ->get();

        return view('companies.create', compact('accountTemplates'));
    }



    /**
     * Store Company
     */
    public function store(Request $request)
    {

        $request->validate([

            'company_name' => 'required|max:255',

            'accounts' => 'nullable|array',

        ]);



        // Create Company

       $company = Company::create([

    'company_name' => $request->company_name,

    'business_type' => $request->business_type,

]);



        // Create Selected Accounts

        if($request->accounts)
        {

            foreach($request->accounts as $template_id)
            {

                $template = AccountTemplate::find($template_id);


                if($template)
                {

                    Account::create([

                        'company_id' => $company->id,

                        'account_code' => $this->generateAccountCode(
                            $template->account_type
                        ),

                        'account_name' => $template->account_name,

                        'account_type' => $template->account_type,

                        'opening_balance' => 0,

                        'balance_type' => $template->balance_type,

                    ]);

                }

            }

        }



        return redirect()

            ->route('companies.index')

            ->with('success','Company created successfully.');

    }




    /**
     * Generate Account Code
     */
    private function generateAccountCode($type)
    {

        $prefix = [

            'Asset'=>1000,

            'Expense'=>2000,

            'Liability'=>3000,

            'Equity'=>4000,

            'Income'=>5000,

        ];



        $lastAccount = Account::where('account_type',$type)

            ->orderBy('account_code','desc')

            ->first();



        if($lastAccount)
        {
            return $lastAccount->account_code + 1;
        }



        return $prefix[$type] + 1;

    }





    /**
     * Edit Company
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
    }




    /**
     * Update Company
     */
    public function update(Request $request, string $id)
    {

      $request->validate([

    'company_name' => 'required|max:255',

    'business_type' => 'required',

    'accounts' => 'nullable|array',

]);



        $company = Company::findOrFail($id);


        $company->update([

            'company_name'=>$request->company_name,

        ]);



        return redirect()

            ->route('companies.index')

            ->with('success','Company updated successfully.');

    }





    /**
     * Delete Company
     */
    public function destroy(string $id)
    {

        $company = Company::findOrFail($id);

        $company->delete();


        return redirect()

            ->route('companies.index')

            ->with('success','Company deleted successfully.');

    }

}