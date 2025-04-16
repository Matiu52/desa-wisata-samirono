<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Paket Wisata, ' . Auth::user()->name . '!') }}
    </x-admin.header>
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="px-2">
                    <x-success-notification :message="session('success')" />
                </div>
            @endif
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <div class="w-full sm:w-auto">
                    @include('admin.tour-packages.components.search', [
                        'label' => 'Search Tour Packages',
                        'name' => 'tour_package_search',
                        'placeholder' => 'Cari Paket Wisata, Harga, atau Pembuat...',
                        'value' => request()->input('keyword'),
                    ])
                </div>
                <a href="{{ route('tour-packages.create') }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center me-2">Buat
                        Paket Wisata
                    </button>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="table-tour-package"
                name="table-tour-package">
                @include('admin.tour-packages.components.table-package')
            </div>
            <x-footer-dashboard></x-footer-dashboard>
        </div>
</x-app-layout>
