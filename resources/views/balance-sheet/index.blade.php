<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-semibold">
            Balance Sheet
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @php
                    $totalAssets = 0;
                    $totalLiabilities = 0;
                @endphp

                <div class="grid grid-cols-2 gap-8">

                    <div>

                        <h3 class="text-xl font-bold mb-3">
                            Assets
                        </h3>

                        <table class="w-full border">

                            @foreach($assets as $account)

                                @php
                                    $balance = $account->ledgerEntries->sum('debit')
                                             - $account->ledgerEntries->sum('credit');

                                    $totalAssets += $balance;
                                @endphp

                                <tr>
                                    <td class="border p-2">
                                        {{ $account->account_name }}
                                    </td>

                                    <td class="border p-2 text-right">
                                        {{ number_format($balance,2) }}
                                    </td>
                                </tr>

                            @endforeach

                            <tr class="font-bold bg-gray-100">
                                <td class="border p-2">
                                    Total Assets
                                </td>

                                <td class="border p-2 text-right">
                                    {{ number_format($totalAssets,2) }}
                                </td>
                            </tr>

                        </table>

                    </div>

                    <div>

                        <h3 class="text-xl font-bold mb-3">
                            Liabilities
                        </h3>

                        <table class="w-full border">

                            @foreach($liabilities as $account)

                                @php
                                    $balance = $account->ledgerEntries->sum('credit')
                                             - $account->ledgerEntries->sum('debit');

                                    $totalLiabilities += $balance;
                                @endphp

                                <tr>
                                    <td class="border p-2">
                                        {{ $account->account_name }}
                                    </td>

                                    <td class="border p-2 text-right">
                                        {{ number_format($balance,2) }}
                                    </td>
                                </tr>

                            @endforeach

                            <tr class="font-bold bg-gray-100">
                                <td class="border p-2">
                                    Total Liabilities
                                </td>

                                <td class="border p-2 text-right">
                                    {{ number_format($totalLiabilities,2) }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>