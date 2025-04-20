@csrf
<div class="flex flex-wrap gap-1">
    <div class="mb-4">
        <label for="packageName" class="block text-gray-700 font-bold mb-2">Nama Paket:</label>
        <input type="text" id="packageName" name="packageName"
            value="{{ old('packageName', $tourPackage->package_name ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>
    <div class="mb-4">
        <label for="duration" class="block text-gray-700 font-bold mb-2">Durasi (hari):</label>
        <input type="text" id="duration" name="duration" value="{{ old('duration', $tourPackage->duration ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>
    <div class="mb-4">
        <label for="price" class="block text-gray-700 font-bold mb-2">Harga (IDR):</label>
        <input type="number" id="price" name="price" value="{{ old('price', $tourPackage->price ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required>
    </div>
</div>


<div id="dynamic-list-container" class="mb-4">
    <label for="listItem" class="block text-gray-700 font-bold mb-2">
        Daftar Kegiatan:
    </label>
    <div class="flex mb-2">
        <input type="text" name="listItems[]"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <button type="button"
            class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            onclick="addItem()">
            Tambah
        </button>
    </div>
    @if (isset($tourPackage->listItems))
        @foreach ($tourPackage->listItems as $item)
            <div class="flex mb-2">
                <input type="text" name="listItems[]" value="{{ $item->name }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="button"
                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    onclick="removeItem(this)"> Hapus
                </button>
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
