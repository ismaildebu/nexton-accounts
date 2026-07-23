<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-semibold">
            Profit & Loss Statement
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @php
                    $totalIncome = 0;
                    $totalExpense = 0;
                @endphp

                <h3 class="text-xl font-bold mb-3">Income</h3>

                <table class="w-full border mb-6">

                    @foreach($incomeAccounts as $account)

                        @php
                            $amount = $account->ledgerEntries->sum('credit')
                                    - $account->ledgerEntries->sum('debit');

                            $totalIncome += $amount;
                        @endphp

                        <tr>
                            <td class="border p-2">
                                {{ $account->account_name }}
                            </td>

                            <td class="border p-2 text-right">
                                {{ number_format($amount,2) }}
                            </td>
                        </tr>

                    @endforeach

                </table>

                <h3 class="text-xl font-bold mb-3">Expenses</h3>

                <table class="w-full border">

                    @foreach($expenseAccounts as $account)

                        @php
                            $amount = $account->ledgerEntries->sum('debit')
                                    - $account->ledgerEntries->sum('credit');

                            $totalExpense += $amount;
                        @endphp

                        <tr>
                            <td class="border p-2">
                                {{ $account->account_name }}
                            </td>

                            <td class="border p-2 text-right">
                                {{ number_format($amount,2) }}
                            </td>
                        </tr>

                    @endforeach

                    <tr class="bg-gray-100 font-bold">
                        <td class="border p-2">
                            Net Profit
                        </td>

                        <td class="border p-2 text-right">
                            {{ number_format($totalIncome - $totalExpense,2) }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>