<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $tourPackage->package_name }}
            </h1>
            <div class="mt-1 bg-white dark:bg-gray-800 p-2 rounded-lg shadow">
                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <span class="font-semibold text-gray-800 dark:text-gray-100">Oleh:</span>
                    <span class="text-blue-600 hover:text-blue-800">{{ $tourPackage->user->name }}</span>
                    <span class="text-gray-600 dark:text-gray-400">pada
                        {{ $tourPackage->created_at->format('j F Y') }}</span>
                </div>
            </div>
        </div>
    </x-admin.header>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Info Paket --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Informasi Paket</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Durasi:</label>
                        <p class="text-gray-800 dark:text-gray-200">{{ $tourPackage->duration }} hari</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga:</label>
                        <p class="text-gray-800 dark:text-gray-200">IDR
                            {{ number_format($tourPackage->price, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Daftar Kegiatan --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Daftar Kegiatan</h2>
                <ul class="list-disc list-inside text-gray-800 dark:text-gray-200">
                    @foreach ($tourPackage->listItems as $item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Deskripsi</h2>
                <p class="text-gray-800 dark:text-gray-200 text-justify">{{ $tourPackage->description }}</p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-center gap-4 mt-6">
                <a href="{{ route('tour-packages.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Paket
                </a>
                <a href="{{ route('tour-packages.edit', $tourPackage->slug) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('tour-packages.destroy', $tourPackage->slug) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus paket ini?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
