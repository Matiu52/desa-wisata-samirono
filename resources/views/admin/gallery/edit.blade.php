<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Gallery: {{ $gallery->title }}
            </h2>
            <x-admin.link-button href="{{ route('dashboard') }}">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </x-admin.link-button>
        </div>
    </x-admin.header>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Masukkan judul galeri" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Masukkan deskripsi galeri">{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    {{-- Tambah Gambar Baru --}}
                    <div class="mb-6">
                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tambah Gambar Baru
                        </label>
                        <input type="file" name="images[]" id="images"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            multiple>
                    </div>

                    {{-- Gambar Saat Ini --}}
                    @if ($gallery->images->isEmpty())
                        <p class="text-gray-500">Belum ada gambar.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                            @foreach ($gallery->images as $image)
                                <div class="relative border p-2 rounded-lg shadow-md bg-gray-50 dark:bg-gray-700">
                                    <img src="{{ asset('images/uploads/' . $image->image_path) }}"
                                        class="w-full h-auto rounded-md">
                                    <p class="text-sm mt-2 text-gray-700 dark:text-gray-300">
                                        {{ $image->caption ?? 'Tanpa keterangan' }}
                                    </p>

                                    {{-- Checkbox hapus --}}
                                    <label class="absolute top-2 right-2 bg-white dark:bg-gray-800 p-1 rounded shadow">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                                        <span class="text-xs text-red-500">Hapus</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
