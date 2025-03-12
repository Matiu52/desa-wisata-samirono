<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Carousel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form action="{{ route('carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ $carousel->title }}">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">{{ $carousel->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Gambar Baru
                            (opsional)</label>
                        <input type="file" name="images[]" id="images"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
                    </div>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
