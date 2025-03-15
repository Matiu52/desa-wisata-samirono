@props(['image', 'title', 'description', 'editUrl', 'deleteUrl'])
<div class="border rounded-lg overflow-hidden shadow hover:shadow-md transition">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    <div class="p-4 space-y-2">
        <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        <p class="text-sm text-gray-600">{{ $description }}</p>
        <div class="flex space-x-2 pt-2">
            <a href="{{ $editUrl }}" class="text-blue-600 hover:underline text-sm">Edit</a>
            <form action="{{ $deleteUrl }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
            </form>
        </div>
    </div>
</div>
