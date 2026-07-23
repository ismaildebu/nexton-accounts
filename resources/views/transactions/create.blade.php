/**
 * Show the form for creating a new resource.
 */
public function create()
{
    $companyId = session('company_id');


    if(!$companyId){

        return redirect()
            ->route('dashboard')
            ->with('error','Please select company first.');

    }



    $company = Company::findOrFail($companyId);



    $accounts = Account::where('company_id', $companyId)

        ->orderBy('account_code')

        ->get();



    return view('transactions.create', compact(

        'company',

        'accounts'

    ));

}





/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{


    $request->validate([


        'company_id' => 'required|exists:companies,id',


        'debit_account_id' => 'required|exists:accounts,id',


        'credit_account_id' => 
        'required|exists:accounts,id|different:debit_account_id',


        'transaction_date' => 'required|date',


        'transaction_type' => 
        'required|in:Income,Expense,Journal',


        'amount' => 'required|numeric|min:0.01',


        'description' => 'nullable|string',


    ]);





    DB::transaction(function () use ($request) {



        // Voucher Number Generate

        $prefix = match($request->transaction_type){


            'Income' => 'INC',


            'Expense' => 'EXP',


            default => 'JV',

        };





        $last = Transaction::latest()->first();



        $next = $last

            ? ((int) substr($last->voucher_no,4)) + 1

            : 1;





        $voucherNo = $prefix.'-'.str_pad(

            $next,

            6,

            '0',

            STR_PAD_LEFT

        );







        // Transaction Create

        $transaction = Transaction::create([



            'company_id' => $request->company_id,



            // legacy account field

            'account_id' => $request->debit_account_id,



            'debit_account_id' => 
            $request->debit_account_id,



            'credit_account_id' => 
            $request->credit_account_id,



            'transaction_date' => 
            $request->transaction_date,



            'voucher_no' => $voucherNo,



            'transaction_type' => 
            $request->transaction_type,



            'amount' => $request->amount,



            'description' => 
            $request->description,



            'created_by' => Auth::id(),


        ]);









        // Debit Ledger Entry


        LedgerEntry::create([


            'transaction_id' => $transaction->id,


            'company_id' => $request->company_id,


            'account_id' => $request->debit_account_id,


            'entry_date' => $request->transaction_date,


            'debit' => $request->amount,


            'credit' => 0,


            'description' => $request->description,


        ]);









        // Credit Ledger Entry


        LedgerEntry::create([


            'transaction_id' => $transaction->id,


            'company_id' => $request->company_id,


            'account_id' => $request->credit_account_id,


            'entry_date' => $request->transaction_date,


            'debit' => 0,


            'credit' => $request->amount,


            'description' => $request->description,


        ]);




    });







    return redirect()

        ->route('transactions.index')

        ->with(

            'success',

            'Transaction posted successfully.'

        );


}