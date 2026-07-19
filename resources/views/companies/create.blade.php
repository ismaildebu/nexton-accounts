<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Company
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-2xl font-bold mb-6">Create New Company</h3>

        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block font-medium mb-2">Company Name</label>
             <input type="text"
                name="company_name"
                class="w-full border rounded px-3 py-2"
                placeholder="Enter Company Name">   
                
            </div>

            <button
                class="bg-blue-600 text-white px-5 py-2 rounded">
                Save Company
            </button>
        </form>

    </div>
</x-app-layout>