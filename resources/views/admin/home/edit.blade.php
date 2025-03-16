<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Section
        </h2>
        <x-admin.link-button href="{{ route('dashboard') }}">
            Kembali ke Dashboard
        </x-admin.link-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <x-success-notification></x-success-notification>
                @if ($images)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gambar saat ini:</p>
                        <div class="flex flex-wrap gap-4">
                            @foreach ($images as $image)
                                <div class="relative w-24 h-24">
                                    <!-- Gambar -->
                                    <img src="{{ asset('images/uploads/' . $image) }}" alt="Image"
                                        class="w-full h-full object-cover rounded-md shadow-md">
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('home-settings.delete-image', $homeSetting) }}"
                                        method="POST" class="absolute top-1 right-1">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="image" value="{{ $image }}">
                                        <button type="submit"
                                            class="bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center shadow-md hover:bg-red-600 focus:outline-none">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('home-settings.update', $homeSetting) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Pilihan Nama Section --}}
                    <div class="mb-4">
                        <label for="section" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Section
                        </label>
                        <select name="section" id="section"
                            class="form-select mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                            <option value="atas" {{ $homeSetting->section === 'atas' ? 'selected' : '' }}>Atas
                            </option>
                            <option value="tengah" {{ $homeSetting->section === 'tengah' ? 'selected' : '' }}>Tengah
                            </option>
                            <option value="bawah" {{ $homeSetting->section === 'bawah' ? 'selected' : '' }}>Bawah
                            </option>
                        </select>
                    </div>

                    {{-- Judul Section --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul
                        </label>
                        <input type="text" name="title" id="title"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            value="{{ $homeSetting->title }}" required>
                    </div>

                    {{-- Konten Section --}}
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Konten
                        </label>
                        <textarea name="content" id="content" rows="3"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ $homeSetting->content }}</textarea>
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
