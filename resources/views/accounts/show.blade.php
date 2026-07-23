<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Account Details
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <p>
                    <strong>Account Code:</strong>
                    {{ $account->account_code }}
                </p>

                <p>
                    <strong>Account Name:</strong>
                    {{ $account->account_name }}
                </p>

                <p>
                    <strong>Account Type:</strong>
                    {{ $account->account_type }}
                </p>

                <p>
                    <strong>Opening Balance:</strong>
                    {{ number_format($account->opening_balance,2) }}
                    {{ $account->balance_type }}
                </p>

                <a href="{{ route('accounts.index') }}"
                   class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded">
                    Back
                </a>

            </div>

        </div>

    </div>

</x-app-layout>