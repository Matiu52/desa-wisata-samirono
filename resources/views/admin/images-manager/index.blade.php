<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Gambar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.images-manager.components.notifications')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form action="{{ route('image.manager.upload') }}" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="flex items-center space-x-6"> <input type="file" name="images[]" multiple required
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 cursor-pointer focus:outline-none">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Unggah</button>
                    </div>
                    @error('images')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @if (empty($images))
                        Tidak ada gambar.
                    @endif
                    @foreach ($images as $image)
                        <div class="relative">
                            <img src="{{ url('images/uploads/' . $image) }}" alt="Image"
                                class="w-full h-48 object-cover">
                            <form action="{{ route('image.manager.delete') }}" method="POST"
                                class="absolute top-0 right-0">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="path" value="{{ $image }}">
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
