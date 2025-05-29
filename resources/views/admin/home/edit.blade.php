<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Section
            </h2>
            <x-admin.link-button href="{{ route('dashboard') }}">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </x-admin.link-button>
        </div>
    </x-admin.header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <x-success-notification></x-success-notification>


                {{-- Form Edit Section --}}
                <form action="{{ route('home-settings.update', $homeSetting) }}" method="POST"
                    enctype="multipart/form-data" class="mt-8">
                    @csrf
                    @method('PUT')
                    {{-- Gambar Saat Ini dengan checkbox hapus --}}
                    @if ($imagesFormat)
                        <div class="mt-6">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Saat Ini:</p>
                            <div class="flex flex-wrap gap-4 mt-4">
                                @foreach ($imagesFormat as $image)
                                    <div class="relative w-24 h-24">
                                        <img src="{{ $image }}" alt="Image"
                                            class="w-full h-full object-cover rounded-md shadow-md">
                                        <label
                                            class="absolute top-1 left-1 bg-white bg-opacity-70 rounded px-1 text-xs flex items-center cursor-pointer">
                                            <input type="checkbox" name="delete_images[]" value="{{ $image }}"
                                                class="mr-1">
                                            Hapus
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Pilihan Nama Section --}}
                    <div class="mb-6">
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
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul
                        </label>
                        <input type="text" name="title" id="title"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            value="{{ $homeSetting->title }}" required>
                    </div>

                    {{-- Konten Section --}}
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Konten
                        </label>
                        <textarea name="content" id="content" rows="4"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ $homeSetting->content }}</textarea>
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-6">
                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tambahkan Gambar Baru
                        </label>
                        <input type="file" name="images[]" id="images"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            multiple>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
