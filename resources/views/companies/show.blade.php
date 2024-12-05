<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">{{ $company->name }}</h3>
                    </div>
                    <div class="mb-4">
                        <strong>Address:</strong>
                        <p>{{ $company->address }}</p>
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong>
                        <p>{{ $company->email }}</p>
                    </div>
                    <div class="mb-4">
                        <strong>Phone:</strong>
                        <p>{{ $company->phone }}</p>
                    </div>

                    <div class="flex mt-4">
                        <a href="{{ route('companies.edit', $company) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('companies.index') }}" class="ml-4 text-gray-500 hover:text-gray-700">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
