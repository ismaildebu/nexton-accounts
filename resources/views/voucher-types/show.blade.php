<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Voucher Type Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="mb-4">
                    <strong>Company:</strong><br>
                    {{ $voucherType->company->company_name }}
                </div>

                <div class="mb-4">
                    <strong>Voucher Name:</strong><br>
                    {{ $voucherType->voucher_name }}
                </div>

                <div class="mb-4">
                    <strong>Voucher Code:</strong><br>
                    {{ $voucherType->voucher_code }}
                </div>

                <div class="mb-4">
                    <strong>Active:</strong><br>
                    {{ $voucherType->is_active ? 'Yes' : 'No' }}
                </div>

                <a href="{{ route('voucher-types.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>

            </div>

        </div>
    </div>

</x-app-layout>