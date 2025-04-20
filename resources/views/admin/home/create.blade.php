<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tambah Section Baru
            </h2>
            <x-admin.link-button href="{{ route('dashboard') }}">
                Kembali ke Dashboard
            </x-admin.link-button>
        </div>
    </x-admin.header>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="{{ route('home-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Pilihan Nama Section --}}
                    <div class="mb-4">
                        <label for="section" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Section
                        </label>
                        <select name="section" id="section"
                            class="form-select mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                            <option value="atas">Atas</option>
                            <option value="tengah">Tengah</option>
                            <option value="bawah">Bawah</option>
                        </select>
                    </div>

                    {{-- Judul Section --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul
                        </label>
                        <input type="text" name="title" id="title"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            required>
                    </div>

                    {{-- Konten Section --}}
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Konten
                        </label>
                        <textarea name="content" id="content" rows="3"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"></textarea>
                    </div>

                    {{-- Konten Carousel --}}
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <input type="file" name="images[]" id="images"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
