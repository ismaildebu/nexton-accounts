<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Trial Balance
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Account Code</th>
                            <th class="border p-2">Account Name</th>
                            <th class="border p-2 text-right">Debit</th>
                            <th class="border p-2 text-right">Credit</th>
                        </tr>
                    </thead>

                    <tbody>

                    @php
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp

                    @foreach($accounts as $account)

                        @php
                            $debit = $account->ledgerEntries->sum('debit');
                            $credit = $account->ledgerEntries->sum('credit');

                            $totalDebit += $debit;
                            $totalCredit += $credit;
                        @endphp

                        <tr>
                            <td class="border p-2">{{ $account->account_code }}</td>
                            <td class="border p-2">{{ $account->account_name }}</td>
                            <td class="border p-2 text-right">{{ number_format($debit,2) }}</td>
                            <td class="border p-2 text-right">{{ number_format($credit,2) }}</td>
                        </tr>

                    @endforeach

                    <tr class="font-bold bg-gray-100">
                        <td colspan="2" class="border p-2 text-right">
                            Total
                        </td>

                        <td class="border p-2 text-right">
                            {{ number_format($totalDebit,2) }}
                        </td>

                        <td class="border p-2 text-right">
                            {{ number_format($totalCredit,2) }}
                        </td>
                    </tr>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>