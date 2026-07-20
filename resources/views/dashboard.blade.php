<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Nexton Accounts ERP') }}
            </h2>

            <span class="text-sm text-gray-500">
                Welcome, {{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold text-blue-700">
                    Welcome to Nexton Accounts ERP
                </h3>

                <p class="mt-3 text-gray-600">
                    Professional Accounting & ERP Solution
                </p>
		<div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">

    <a href="{{ route('companies.index') }}"
       class="bg-indigo-100 p-4 rounded-lg hover:bg-indigo-200">

        <h4 class="font-bold text-indigo-700">
            🏢 Companies
        </h4>

        <p class="text-sm text-gray-600 mt-1">
            Manage Companies
        </p>

    </a>


    <div class="bg-purple-100 p-4 rounded-lg">

        <h4 class="font-bold text-purple-700">
            📒 Accounts
        </h4>

        <p class="text-sm text-gray-600 mt-1">
            Chart of Accounts
        </p>

    </div>


    <div class="bg-orange-100 p-4 rounded-lg">

        <h4 class="font-bold text-orange-700">
            💰 Transactions
        </h4>

        <p class="text-sm text-gray-600 mt-1">
            Income & Expense
        </p>

    </div>


    <div class="bg-pink-100 p-4 rounded-lg">

        <h4 class="font-bold text-pink-700">
            📊 Reports
        </h4>

        <p class="text-sm text-gray-600 mt-1">
            Financial Reports
        </p>

    </div>

</div>


                <hr class="my-5">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="bg-blue-100 p-5 rounded-lg">
                        <h4 class="font-bold">Cash Balance</h4>
                        
                        <p class="text-2xl mt-2">
    ৳ {{ number_format($cashBalance,2) }}
</p>
                    </div>

                    <div class="bg-green-100 p-5 rounded-lg">
                        <h4 class="font-bold">Bank Balance</h4>
                        <p class="text-2xl mt-2">
    ৳ {{ number_format($bankBalance,2) }}
</p>
                    </div>

                    <div class="bg-yellow-100 p-5 rounded-lg">
                        <h4 class="font-bold">Today's Income</h4>
                        
                        <p class="text-2xl mt-2">
    ৳ {{ number_format($todayIncome,2) }}
</p>
                    </div>

                    <div class="bg-red-100 p-5 rounded-lg">
                        <h4 class="font-bold">Today's Expense</h4>
                        
                        <p class="text-2xl mt-2">
    ৳ {{ number_format($todayExpense,2) }}
</p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>