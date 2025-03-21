<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tambah Gallery Baru
            </h2>
            <x-admin.link-button href="{{ route('dashboard') }}">
                Kembali ke Dashboard
            </x-admin.link-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block font-medium">Judul</label>
                        <input type="text" name="title" id="title" class="form-input w-full" required>
                    </div>

                    <div>
                        <label for="description" class="block font-medium">Deskripsi</label>
                        <textarea name="description" id="description" class="form-textarea w-full"></textarea>
                    </div>

                    <div>
                        <label for="images" class="block font-medium">Gambar (bisa pilih lebih dari 1)</label>
                        <input type="file" name="images[]" id="images" class="form-input w-full" multiple
                            required>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
