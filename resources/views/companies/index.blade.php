<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Company List
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Companies</h3>

    <a href="{{ route('companies.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Company
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2 text-left">ID</th>
            <th class="border p-2 text-left">Company Name</th>
        </tr>
    </thead>

    <tbody>
        @forelse($companies as $company)
            <tr>
                <td class="border p-2">{{ $company->id }}</td>
                <td class="border p-2">{{ $company->company_name }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="border p-4 text-center">
                    No Company Found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

    
    </div>
</x-app-layout>