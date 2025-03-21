<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang di Post, ' . Auth::user()->name . '!') }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search + Button --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <div class="w-full sm:w-auto">
                    <x-success-notification />
                    @include('admin.posts.components.search', [
                        'label' => 'Search Post',
                        'name' => 'post_search',
                        'placeholder' => 'Cari Postingan atau Pembuat...',
                        'value' => request()->input('keyword'),
                    ])
                </div>
                <a href="{{ route('posts.create') }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center">
                        Buat Artikel
                    </button>
                </a>
            </div>

            {{-- Table Section --}}
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
                @include('admin.posts.components.table-post')
            </div>

            {{-- Footer --}}
            <x-footer-dashboard />
        </div>
    </div>
</x-app-layout>
