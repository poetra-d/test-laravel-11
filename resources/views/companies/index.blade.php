<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('companies.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Add Company
                    </a>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table-auto w-full text-left mt-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Address</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Phone</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td class="border px-4 py-2">{{ $company->name }}</td>
                                    <td class="border px-4 py-2">{{ $company->address }}</td>
                                    <td class="border px-4 py-2">{{ $company->email }}</td>
                                    <td class="border px-4 py-2">{{ $company->phone }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('companies.show', $company) }}" class="text-blue-500 hover:underline">View</a> |
                                        <a href="{{ route('companies.edit', $company) }}" class="text-yellow-500 hover:underline">Edit</a> |
                                        <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center">No companies found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>