<x-modalE form-action="storeUserData">
    <x-slot name="title">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text"  id="name" wire:model="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="John">
        </div>
        @error('name')
            <div class="form-error">
                *{{ $message }}
            </div>
        @enderror
    </x-slot>

    <x-slot name="email">
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                address</label>
            <input type="email"  wire:model="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="john.doe@company.com">
        </div>
        @error('email')
            <div class="form-error">
                *{{ $message }}
            </div>
        @enderror
    </x-slot>
    <x-slot name="password">
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password"  wire:model="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        @error('email')
            <div class="form-error">
                *{{ $message }}
            </div>
        @enderror
    </x-slot>

    <x-slot name="buttons">
        <button
            class="bg-green-500 hover:bg-blue-400 text-white font-bold mr-4 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            type="submit">Create</button>
        <button wire:click="$emit('closeModal')"
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Cancel</button>
    </x-slot>
</x-modalE>
