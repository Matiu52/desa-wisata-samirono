<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Pengaturan Postingan, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="py-6 bg-gray-50 dark:bg-gray-900 h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="px-2">
                    <x-success-notification :message="session('success')" />
                </div>
            @endif

            {{-- Search + Button --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <div class="w-full sm:w-auto">
                    @include('admin.posts.components.search', [
                        'label' => 'Search Post',
                        'name' => 'post_search',
                        'placeholder' => 'Cari Postingan atau Pembuat...',
                        'value' => request()->input('keyword'),
                    ])
                </div>
                <x-admin.link-button href="{{ route('posts.create') }}">
                    Tambah Post
                </x-admin.link-button>
            </div>

            {{-- Table Section --}}
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
                <div id="table-post">
                    @include('admin.posts.components.table-post')
                </div>
            </div>

            {{-- Footer --}}
            <x-footer-dashboard />
        </div>
    </div>
</x-app-layout>
