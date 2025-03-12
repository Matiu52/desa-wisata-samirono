<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang di Pesanan, ' . Auth::user()->name . '!') }}
        </h2>
    </x-slot>
    <div class="my-4 h-auto bg-gray-50/50">
        <div class="p-4 2xl:ml-80">
            <div class="">
                <div class="flex justify-between items-center">
                    <div class="pb-4 bg-gray-50/50 dark:bg-gray-900">
                        <x-success-notification></x-success-notification>
                        @include('admin.tour-packages.components.search', [
                            'label' => 'Search Tour Packages',
                            'name' => 'tour_package_search',
                            'placeholder' => 'Cari Pesanan...',
                            'value' => request()->input('keyword'),
                        ])
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="table-tour-package"
                    name="table-tour-package">
                </div>
                <x-footer-dashboard></x-footer-dashboard>
            </div>
        </div>
</x-app-layout>
