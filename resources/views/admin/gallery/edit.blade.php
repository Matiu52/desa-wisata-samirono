<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Gallery: {{ $gallery->title }}
            </h2>
            <x-admin.link-button href="{{ route('dashboard') }}">
                Kembali ke Dashboard
            </x-admin.link-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Judul</label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                            class="form-input w-full">
                    </div>

                    <div class="mb-4">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-textarea w-full">{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label>Tambah Gambar Baru</label>
                        <input type="file" name="images[]" multiple class="form-input w-full">
                    </div>

                    @if ($gallery->images->isEmpty())
                        <p class="text-gray-500">Belum ada gambar.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            @foreach ($gallery->images as $image)
                                <div class="border p-2 rounded shadow relative">
                                    <img src="{{ asset('images/uploads/' . $image->image_path) }}"
                                        class="w-full h-auto rounded">
                                    <p class="text-sm mt-2">{{ $image->caption ?? 'Tanpa keterangan' }}</p>

                                    {{-- Checkbox hapus --}}
                                    <label class="absolute top-2 right-2 bg-white p-1 rounded shadow">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                                        <span class="text-xs text-red-500">Hapus</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-end">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
