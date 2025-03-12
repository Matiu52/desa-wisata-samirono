<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Carousel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <a href="{{ route('carousel.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Buat
                    Carousel
                    Baru</a>
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 mt-5">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @if ($carousels->isEmpty())
                        Tidak ada gambar.
                    @else
                        @foreach ($carousels as $carousel)
                            <div class="relative">
                                <img src="{{ asset('images/uploads/' . $carousel->image_path) }}"
                                    alt="{{ $carousel->title }}" class="w-full h-48 object-cover">
                                <div class="mt-2">
                                    <h3 class="text-lg font-semibold">{{ $carousel->title }}</h3>
                                    <p class="text-sm">{{ $carousel->description }}</p> <a
                                        href="{{ route('carousel.edit', $carousel->id) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded inline-flex items-center justify-center">Edit</a>
                                    <form action="{{ route('carousel.destroy', $carousel->id) }}" method="POST"
                                        class="inline-block"> @csrf @method('DELETE') <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded inline-flex items-center justify-center">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
