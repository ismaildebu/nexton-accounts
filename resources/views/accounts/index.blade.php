<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-2xl text-gray-800">
                Chart of Accounts
            </h2>

            <a href="{{ route('accounts.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Account
            </a>

        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">


                @if(session('success'))

                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

                        {{ session('success') }}

                    </div>

                @endif



                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-2 text-left">
                                Code
                            </th>

                            <th class="border p-2 text-left">
                                Account Name
                            </th>

                            <th class="border p-2 text-left">
                                Type
                            </th>

                            <th class="border p-2 text-left">
                                Company
                            </th>

                            <th class="border p-2 text-left">
                                Balance
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($accounts as $account)

                            <tr>

                                <td class="border p-2">
                                    {{ $account->account_code }}
                                </td>


                                <td class="border p-2 font-semibold">
                                    {{ $account->account_name }}
                                </td>


                                <td class="border p-2">
                                    {{ $account->account_type }}
                                </td>


                                <td class="border p-2">
                                    {{ $account->company->company_name ?? '' }}
                                </td>


                                <td class="border p-2">

                                    {{ number_format($account->opening_balance,2) }}

                                    {{ $account->balance_type }}

                                </td>


                            </tr>


                        @empty

                            <tr>

                                <td colspan="5"
                                    class="border p-4 text-center">

                                    No Account Found

                                </td>

                            </tr>

                        @endforelse


                    </tbody>


                </table>


            </div>

        </div>

    </div>


</x-app-layout>