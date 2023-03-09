<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Liste des posts') }}
                </div>
            </div>
        </div>
        <div class="grid_container">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="grid_items bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 ">
                        <div>{{ $post['title'] }}</div>
                        <div>{{ $post['content'] }}</div>
                        <div class="grid_btns">
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <p>There is no Posts to Display</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
