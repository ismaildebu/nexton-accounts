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

                <hr class="my-5">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="bg-blue-100 p-5 rounded-lg">
                        <h4 class="font-bold">Cash Balance</h4>
                        <p class="text-2xl mt-2">৳ 0.00</p>
                    </div>

                    <div class="bg-green-100 p-5 rounded-lg">
                        <h4 class="font-bold">Bank Balance</h4>
                        <p class="text-2xl mt-2">৳ 0.00</p>
                    </div>

                    <div class="bg-yellow-100 p-5 rounded-lg">
                        <h4 class="font-bold">Today's Income</h4>
                        <p class="text-2xl mt-2">৳ 0.00</p>
                    </div>

                    <div class="bg-red-100 p-5 rounded-lg">
                        <h4 class="font-bold">Today's Expense</h4>
                        <p class="text-2xl mt-2">৳ 0.00</p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>