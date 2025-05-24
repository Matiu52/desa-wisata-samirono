@props(['galleries'])

@if ($galleries->isEmpty())
    <x-admin.empty-message>Tidak ada gambar kunjungan.</x-admin.empty-message>
@else
    <div class="bg-gray-100 p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($galleries as $gallery)
                <div
                    class="bg-white border border-gray-300 rounded-lg shadow-sm p-4 h-full flex flex-col justify-between">
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $gallery->title }}</h2>
                            <x-admin.action-buttons edit="{{ route('gallery.edit', $gallery->id) }}"
                                delete="{{ route('gallery.destroy', $gallery->id) }}" />
                        </div>

                        <p class="text-sm text-gray-600 mb-4">{{ $gallery->description }}</p>

                        <div class="flex gap-2 overflow-hidden rounded">
                            @foreach ($gallery->images->take(3) as $image)
                                <img src="{{ $image->image_path }}" alt="{{ $image->caption }}"
                                    class="w-1/3 h-24 object-cover rounded border border-gray-200">
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
