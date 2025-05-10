<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Pesanan, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-16">
        {{-- Success Notification --}}
        @if (session('success'))
            <div class="px-2">
                <x-success-notification :message="session('success')" />
            </div>
        @endif

        {{-- Orders Section --}}
        <x-admin.section title="Daftar Pesanan">
            <x-admin.card>
                <div id="orders-body">
                    <x-admin.partials.orders-body :orders="$orders" />
                </div>
            </x-admin.card>
        </x-admin.section>
    </div>
</x-app-layout>
