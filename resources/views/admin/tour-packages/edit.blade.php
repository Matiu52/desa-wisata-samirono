@if (Auth::check())
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Silakan Edit Paket Wisata, ' . Auth::user()->name . '!') }}
            </h2>
        </x-slot>
        <div class="my-4 h-auto bg-gray-50/50">
            <a href="{{ route('tour-packages.index') }}"
                class="ml-2 sm:ml-4 2xl:ml-80 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali
                ke
                Daftar Paket
            </a>
            <div class="p-4 2xl:ml-80 place-items-center">
                <h1 class="text-3xl font-bold mb-6">Edit Paket Wisata</h1>
                <form action="{{ route('tour-packages.update', $tourPackage->id) }}" method="POST">
                    @method('PUT')
                    @include('admin.tour-packages.components.form-package', [
                        'btnText' => 'Edit Paket Wisata',
                    ])
                </form>
                <x-footer-dashboard></x-footer-dashboard>
            </div>
        </div>
    </x-app-layout>
@else
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
