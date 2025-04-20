<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Postingan: ' . $post->title) }}
            </h2>
        </div>
    </x-admin.header>

    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Info Post --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $post->title }}</h2>

                <div class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                    <span class="font-semibold">Oleh:</span> <span class="text-blue-600">{{ $post->user->name }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $post->created_at->format('j F Y') }}</span>
                </div>

                <div class="mb-3">
                    <span class="text-gray-500">Kategori:</span>
                    <span class="font-semibold text-gray-700 dark:text-white">{{ $post->category }}</span>
                </div>

                @isset($post->tags)
                    <div class="mb-3">
                        <span class="text-gray-500">Tags:</span>
                        <span class="bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold inline-block">
                            {{ $post->tags }}
                        </span>
                    </div>
                @endisset
            </div>

            {{-- Konten Post --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Isi Konten</h3>
                <div class="prose dark:prose-invert max-w-none">
                    {!! $post->content !!}
                </div>
            </div>

            {{-- Aksi --}}
            <div class="flex justify-center gap-4 mb-10">
                <a href="{{ route('posts.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Post
                </a>

                <a href="{{ route('posts.edit', $post->slug) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>

                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus post ini?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>

            {{-- Komentar --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Komentar</h3>

                @forelse ($post->comments as $comment)
                    <div class="mb-4 p-4 border rounded bg-gray-50 dark:bg-gray-900">
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                            <strong>{{ $comment->user->name ?? 'Anonim' }}</strong>: {{ $comment->content }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>

                        {{-- Tombol Balas --}}
                        <button onclick="toggleReplyForm({{ $comment->id }})"
                            class="text-sm text-blue-500 hover:underline">Balas</button>

                        {{-- Tombol Hapus (hanya untuk Admin) --}}
                        @if (auth()->user() && auth()->user()->role_id === 1)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:underline"
                                    onclick="return confirm('Yakin ingin menghapus komentar ini?')">Hapus</button>
                            </form>
                        @endif

                        {{-- Form Balasan --}}
                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-2">
                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                @csrf
                                <textarea name="reply" class="w-full p-2 border rounded" placeholder="Tulis balasan..." required></textarea>
                                <button type="submit"
                                    class="mt-1 px-3 py-1 bg-blue-500 text-white rounded">Kirim</button>
                            </form>
                        </div>

                        {{-- Tampilkan Balasan --}}
                        @foreach ($comment->replies as $reply)
                            <div class="ml-6 mt-2 p-3 bg-gray-100 dark:bg-gray-700 rounded">
                                <p class="text-sm text-gray-700 dark:text-gray-200">
                                    <strong>{{ $reply->user->name ?? 'Anonim' }}</strong>: {{ $reply->content }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $reply->created_at->diffForHumans() }}
                                </p>

                                {{-- Tombol Hapus Balasan (hanya untuk Admin) --}}
                                @if (auth()->user() && auth()->user()->role_id === 1)
                                    <form action="{{ route('comments.destroy', $reply->id) }}" method="POST"
                                        class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:underline"
                                            onclick="return confirm('Yakin ingin menghapus balasan ini?')">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">Belum ada komentar.</p>
                @endforelse
            </div>

            <script>
                function toggleReplyForm(commentId) {
                    const form = document.getElementById('reply-form-' + commentId);
                    form.classList.toggle('hidden');
                }
            </script>

            {{-- Footer --}}
            <x-footer-dashboard />
        </div>
    </div>
</x-app-layout>
