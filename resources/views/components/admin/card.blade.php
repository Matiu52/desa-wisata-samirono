<div class="bg-white shadow rounded-xl p-6 space-y-4">
    {{-- Search & Action --}}
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        {{-- Form pencarian jika ada --}}
        @isset($search)
            <div class="w-full sm:w-auto">
                {{ $search }}
            </div>
        @endisset

        {{-- Tombol aksi jika ada --}}
        @isset($action)
            <div>
                {{ $action }}
            </div>
        @endisset
    </div>
    {{ $slot }}
</div>
