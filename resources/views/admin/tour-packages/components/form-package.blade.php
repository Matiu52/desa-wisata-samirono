@csrf
{{-- Input untuk Nama Paket, Durasi, dan Harga --}}
<div class="flex flex-wrap gap-1">
    <div class="mb-4 flex-1 min-w-[200px]">
        <label for="packageName" class="block text-gray-700 font-bold mb-2">Nama Paket:</label>
        <input type="text" id="packageName" name="packageName"
            value="{{ old('packageName', $tourPackage->package_name ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>

    <div class="mb-4 flex-1 min-w-[100px]">
        <label for="duration" class="block text-gray-700 font-bold mb-2">Durasi (hari):</label>
        <input type="text" id="duration" name="duration" value="{{ old('duration', $tourPackage->duration ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>

    <div class="mb-4 flex-1 min-w-[100px]">
        <label for="price" class="block text-gray-700 font-bold mb-2">Harga (IDR):</label>
        <input type="number" id="price" name="price" value="{{ old('price', $tourPackage->price ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>
</div>

{{-- Tambah Banyak Gambar --}}
<div class="mb-4">
    <label for="images" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Gambar Paket (Bisa lebih dari
        1)</label>
    <input type="file" name="images[]" id="images" accept="image/*" multiple
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
    @error('images')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    {{-- Tampilkan gambar yang sudah ada (hanya saat edit) --}}
    @if (isset($tourPackage) && $tourPackage->images)
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach ($tourPackage->images as $image)
                <div class="relative w-40 h-40 overflow-hidden rounded-md shadow-md border border-gray-300 p-1">
                    <img src="https://res.cloudinary.com/{{ config('cloudinary.cloud_name') }}/image/upload/{{ $image->image_path }}"
                        alt="Gambar" class="w-full h-full object-cover rounded-md">

                    {{-- Checkbox hapus --}}
                    <label
                        class="absolute bottom-1 left-1 bg-white bg-opacity-75 rounded px-1 py-0.5 text-xs flex items-center gap-1 cursor-pointer select-none">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                            class="form-checkbox text-red-600">
                        Hapus
                    </label>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Daftar Kegiatan Dinamis --}}
<div id="dynamic-list-container" class="mb-4">
    <label for="listItem" class="block text-gray-700 font-bold mb-2">Daftar Kegiatan:</label>
    <div class="flex mb-2">
        <input type="text" name="listItems[]"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <button type="button"
            class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            onclick="addItem()">Tambah</button>
    </div>

    {{-- Untuk edit, isi listItems --}}
    @if (isset($tourPackage) && $tourPackage->listItems)
        @foreach ($tourPackage->listItems as $item)
            <div class="flex mb-2">
                <input type="text" name="listItems[]" value="{{ $item->name }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="button"
                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    onclick="removeItem(this)">Hapus</button>
            </div>
        @endforeach
    @endif
</div>

<div class="mb-4">
    <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi Paket:</label>
    <textarea id="description" name="description"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        rows="5" required>{{ old('description', $tourPackage->description ?? '') }}</textarea>
</div>
<script>
    function addItem() {
        const container = document.getElementById('dynamic-list-container');
        const div = document.createElement('div');
        div.className = 'flex mb-2';
        div.innerHTML =
            ` <input type="text" name="listItems[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required> <button type="button" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="removeItem(this)">Hapus</button> `;
        container.appendChild(div);
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>
