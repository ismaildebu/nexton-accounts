<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Add Transaction
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <!-- Company -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Company
                        </label>

                        <select name="company_id"
                                class="w-full border rounded px-3 py-2"
                                required>

                            <option value="">Select Company</option>

                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->company_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    
                    <!-- Debit Account -->
<div class="mb-4">
    <label class="block font-semibold mb-2">
        Debit Account
    </label>

    <select name="debit_account_id"
            class="w-full border rounded px-3 py-2"
            required>

        <option value="">Select Debit Account</option>

        @foreach($accounts as $account)
            <option value="{{ $account->id }}">
                {{ $account->account_code }} -
                {{ $account->account_name }}
            </option>
        @endforeach

    </select>
</div>

<!-- Credit Account -->
<div class="mb-4">
    <label class="block font-semibold mb-2">
        Credit Account
    </label>

    <select name="credit_account_id"
            class="w-full border rounded px-3 py-2"
            required>

        <option value="">Select Credit Account</option>

        @foreach($accounts as $account)
            <option value="{{ $account->id }}">
                {{ $account->account_code }} -
                {{ $account->account_name }}
            </option>
        @endforeach

    </select>
</div>

                    <!-- Date -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Transaction Date
                        </label>

                        <input
                            type="date"
                            name="transaction_date"
                            value="{{ date('Y-m-d') }}"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Transaction Type
                        </label>

                        <select name="transaction_type"
                                class="w-full border rounded px-3 py-2"
                                required>

                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                            <option value="Journal">Journal</option>

                        </select>
                    </div>

                    <!-- Amount -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            class="w-full border rounded px-3 py-2"
                            placeholder="0.00"
                            required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border rounded px-3 py-2"
                            placeholder="Transaction description..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Save Transaction

                        </button>

                        <a href="{{ route('transactions.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>