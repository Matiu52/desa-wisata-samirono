<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $post->title }}</h2>
        <div class="mt-6 p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <div class="text-sm text-gray-600">
                    <span class="font-semibold text-gray-800">Oleh</span>
                    <span class="text-blue-600 hover:text-blue-800">{{ $post->user->name }}</span>
                    <span class="text-gray-600">pada {{ $post->created_at->format('j F Y') }}</span>
                </div>
            </div>
            <div class="mb-4">
                <span class="text-gray-500">Kategori:</span>
                <span class="font-semibold text-gray-700">{{ $post->category }}</span>
            </div>
            @isset($post->tags)
                <div class="mb-4">
                    <span class="text-gray-500">Tags:</span>
                    <span
                        class="bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold mr-2">{{ $post->tags }}</span>
                </div>
            @endisset
        </div>
    </x-slot>

    <div class="my-4 flex h-auto bg-gray-50/50">
        <div class="p-4 w-full 2xl:ml-80">
            <h2 class="mb-4 text-2xl font-semibold">Isi Konten</h2>
            <div class="bg-white p-6 rounded-lg shadow-md custom-content">
                <div class="mb-12">
                    {!! $post->content !!}
                </div>
            </div>
            <div class="mt-6 flex justify-center space-x-2">
                <a href="{{ route('posts.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali ke Daftar Post
                </a>
                <a href="{{ route('posts.edit', $post->slug) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">Edit</a>
                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">Hapus</button>
                </form>
            </div>
            <x-footer-dashboard></x-footer-dashboard>
        </div>
    </div>
</x-app-layout>
