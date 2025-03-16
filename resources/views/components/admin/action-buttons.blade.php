@props(['edit', 'delete'])
<div class="flex space-x-2 justify-center items-center">
    <a href="{{ $edit }}" class="text-blue-600 hover:underline">Edit</a>
    <form action="{{ $delete }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
    </form>
</div>
