<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $tourPackage->package_name }}
        </h1>
        <div class="mt-1 bg-white rounded-lg">
            <div class="flex items-center">
                <div class="text-sm text-gray-600">
                    <span class="font-semibold text-gray-800">Oleh</span>
                    <span class="text-blue-600 hover:text-blue-800">{{ $tourPackage->user->name }}</span>
                    <span class="text-gray-600">pada {{ $tourPackage->created_at->format('j F Y') }}</span>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="my-4 h-auto bg-gray-50/50 flex">
        <div class="p-4 2xl:ml-80 w-full">
            <div class="mb-4"> <label class="flex justify-center text-gray-700 font-bold mb-2">Durasi:</label>
                <p class="flex justify-center text-gray-800">{{ $tourPackage->duration }} hari</p>
            </div>
            <div class="mb-4"> <label class="flex justify-center text-gray-700 font-bold mb-2">Harga:</label>
                <p class="flex justify-center text-gray-800">IDR {{ number_format($tourPackage->price, 2, ',', '.') }}
                </p>
            </div>
            <div class="mb-4"> <label class="flex justify-center text-gray-700 font-bold mb-2">Daftar
                    Kegiatan:</label>
                <ul class="list-disc list-inside text-gray-800">
                    @foreach ($tourPackage->listItems as $item)
                        <li class="flex justify-center">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-4"> <label class="flex justify-center text-gray-700 font-bold mb-2">Deskripsi:</label>
                <div class="flex justify-center">
                    <p class="text-gray-800 w-1/2 text-justify">{{ $tourPackage->description }}</p>
                </div>
            </div>
            <div class="mt-6 flex space-x-2 justify-center">
                <a href="{{ route('tour-packages.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali ke Daftar Paket
                </a>
                <a href="{{ route('tour-packages.edit', $tourPackage->slug) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">Edit</a>
                <form action="{{ route('tour-packages.destroy', $tourPackage->slug) }}" method="POST"
                    class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">Hapus</button>
                </form>
            </div>
        </div>
        <x-footer-dashboard></x-footer-dashboard>
    </div>
</x-app-layout>
