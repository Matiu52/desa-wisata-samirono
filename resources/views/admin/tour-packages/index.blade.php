<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Paket Wisata, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="py-6 bg-white dark:bg-gray-900 h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="px-2">
                    <x-success-notification :message="session('success')" />
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                <div class="w-full sm:w-auto">
                    @include('admin.tour-packages.components.search', [
                        'label' => 'Search Tour Packages',
                        'name' => 'tour_package_search',
                        'placeholder' => 'Cari Paket Wisata, Harga, atau Pembuat...',
                        'value' => request()->input('keyword'),
                    ])
                </div>
                <x-admin.link-button href="{{ route('tour-packages.create') }}">
                    Tambah Paket Wisata
                </x-admin.link-button>
            </div>


            <!-- Tabel -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
                @include('admin.tour-packages.components.table-package')
            </div>

            <x-footer-dashboard />
        </div>
    </div>
</x-app-layout>
