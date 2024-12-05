<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <textarea id="address" name="address" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" id="phone" name="phone" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                        <a href="{{ route('companies.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>