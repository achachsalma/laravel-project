<x-modald form-action="delete">
    <x-slot name="buttons">
        <button
            class="bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm"
            type="submit">Delete</button>
        <button wire:click="$emit('closeModal')"
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold px-3 py-2 m-1 border border-gray-400 rounded shadow">Cancel</button>
    </x-slot>
</x-modald>
