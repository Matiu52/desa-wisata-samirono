<!-- Gallery Container -->
<div class="flex items-center justify-center px-4 sm:px-0">
    <div class="w-full max-w-6xl">
        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($carousels as $carousel)
                <a href="{{ route('gallery.detail', $carousel->id) }}"
                    class="relative rounded-lg shadow-lg overflow-hidden group block h-full">
                    <!-- Show first 3 images as a preview -->
                    @if ($carousel->images->count() > 0)
                        @foreach ($carousel->images->take(3) as $image)
                            <img src="{{ asset('images/uploads/' . $image->image_path) }}" alt="{{ $carousel->title }}"
                                class="w-full h-40 sm:h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        @endforeach
                    @else
                        <!-- Placeholder if no images -->
                        <div class="w-full h-40 sm:h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No images</span>
                        </div>
                    @endif

                    <!-- Always visible overlay with text centered -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col items-center justify-end text-center p-4">
                        <h2 class="text-base sm:text-lg font-bold text-white drop-shadow-md">
                            {{ $carousel->title ?? 'Untitled Gallery' }}
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-200 mt-1 drop-shadow-md">
                            {{ $carousel->description ? Str::limit($carousel->description, 25) : 'No description' }}
                        </p>
                        <p class="text-xs text-gray-300 mt-2 drop-shadow-md">
                            {{ $carousel->images->count() }} gambar
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
