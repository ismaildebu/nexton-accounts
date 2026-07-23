<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
    Edit Account
</h2>
    
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('accounts.update', $account) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Company -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Company</label>

                        <select name="company_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Select Company --</option>
                        
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ old('company_id', $account->company_id) == $company->id ? 'selected' : '' }}>
                                 {{ $company->company_name }}
                             </option>
                        @endforeach
                            
                            
                        </select>
                    </div>

                    <!-- Account Code -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Account Code</label>

                        <input
                            type="text"
                            name="account_code"
                            value="{{ old('account_code', $account->account_code) }}"
                            class="w-full border rounded px-3 py-2"
                            placeholder="1001">
                        
                        </div>

                    <!-- Account Name -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Account Name</label>

                        <input
                            type="text"
                            name="account_name"
                            value="{{ old('account_name', $account->account_name) }}"
                            class="w-full border rounded px-3 py-2"
                            required
                            placeholder="Cash">
                    </div>

                    <!-- Account Type -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Account Type</label>

                        <select name="account_type" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Select Type --</option>
                            
                         <option value="Asset"
                            {{ old('account_type', $account->account_type) == 'Asset' ? 'selected' : '' }}>
                            Asset
                        </option>

                        <option value="Liability"
                            {{ old('account_type', $account->account_type) == 'Liability' ? 'selected' : '' }}>
                            Liability
                        </option>

                        <option value="Equity"
                            {{ old('account_type', $account->account_type) == 'Equity' ? 'selected' : '' }}>
                            Equity
                        </option>

                        <option value="Income"
                            {{ old('account_type', $account->account_type) == 'Income' ? 'selected' : '' }}>
                            Income
                        </option>

                        <option value="Expense"
                            {{ old('account_type', $account->account_type) == 'Expense' ? 'selected' : '' }}>
                            Expense
                        </option>   
                            
                        </select>
                    </div>

                    <!-- Parent Account -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Parent Account</label>

                        <select name="parent_id" class="w-full border rounded px-3 py-2">
                           
                        <option value="">None</option>
                            @foreach($parentAccounts as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ old('parent_id', $account->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->account_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Opening Balance -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Opening Balance</label>

                      <input
                            type="number"
                            step="0.01"
                            name="opening_balance"
                            value="{{ old('opening_balance', $account->opening_balance) }}"
                            class="w-full border rounded px-3 py-2">  
                                                
                         </div>

                    <!-- Balance Type -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Balance Type</label>

                        <select name="balance_type" class="w-full border rounded px-3 py-2">
                           <option value="Debit"
                                {{ old('balance_type', $account->balance_type) == 'Debit' ? 'selected' : '' }}>
                                Debit
                            </option>

                            <option value="Credit"
                                {{ old('balance_type', $account->balance_type) == 'Credit' ? 'selected' : '' }}>
                                Credit
                            </option> 
                            
                        </select>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Save Account

                        </button>

                        <a href="{{ route('accounts.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>