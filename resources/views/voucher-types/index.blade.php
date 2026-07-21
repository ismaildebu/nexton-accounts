<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Voucher Types
            </h2>

            <a href="{{ route('voucher-types.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Voucher Type
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Company</th>
                            <th class="border p-2">Voucher Name</th>
                            <th class="border p-2">Code</th>
                            <th class="border p-2">Active</th>
                            <th class="border p-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($voucherTypes as $voucherType)

                        <tr>

                            <td class="border p-2">
                                {{ $voucherType->company->company_name ?? '' }}
                            </td>

                            <td class="border p-2">
                                {{ $voucherType->voucher_name }}
                            </td>

                            <td class="border p-2">
                                {{ $voucherType->voucher_code }}
                            </td>

                            <td class="border p-2 text-center">
                                {{ $voucherType->is_active ? 'Yes' : 'No' }}
                            </td>

                            <td class="border p-2 text-center">
                                Action
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="border p-4 text-center">
                                No Voucher Type Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>