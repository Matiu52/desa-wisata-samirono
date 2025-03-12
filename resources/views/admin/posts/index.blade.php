<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang di Post, ' . Auth::user()->name . '!') }}
        </h2>
    </x-slot>
    <div class="my-4 h-auto bg-gray-50/50">
        <div class="p-4 2xl:ml-80">
            <div class="">
                <div class="flex justify-between items-center">
                    <div class="pb-4 bg-gray-50/50 dark:bg-gray-900">
                        <x-success-notification></x-success-notification>
                        @include('admin.posts.components.search', [
                            'label' => 'Search Post',
                            'name' => 'post_search',
                            'placeholder' => 'Cari Postingan atau Pembuat...',
                            'value' => request()->input('keyword'),
                        ])
                    </div>
                    <a href="{{ route('posts.create') }}">
                        <button type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center me-2">Buat
                            Artikel
                        </button>
                    </a>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="table-post" name="table-post">
                    @include('admin.posts.components.table-post')
                </div>
                <x-footer-dashboard></x-footer-dashboard>
            </div>
        </div>
</x-app-layout>
