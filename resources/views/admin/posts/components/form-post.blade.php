@csrf
<div class="mb-4">
    <label for="title" class="block text-gray-700 font-bold mb-2">Judul:</label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        required>
</div>
<div class="mb-4">
    <label for="content" class="block text-gray-700 font-bold mb-2">Isi Konten:</label>
    <x-summernote id="content" name="content" :value="$post->content ?? ''"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        rows="5"></x-summernote>
</div>
<div class="mb-4">
    <label for="category" class="block text-gray-700 font-bold mb-2">Kategori:</label>
    <input type="text" id="category" name="category" value="{{ old('category', $post->category ?? '') }}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        required>
</div>
<div class="mb-4">
    <label for="tags" class="block text-gray-700 font-bold mb-2">Tags:</label>
    <input type="text" id="tags" name="tags" value="{{ old('tags', $post->tags ?? '') }}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>
