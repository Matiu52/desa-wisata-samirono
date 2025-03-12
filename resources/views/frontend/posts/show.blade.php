<x-user-layout>
    <div class="my-8 flex flex-col items-center bg-gray-100">
        <div class="p-6 w-full max-w-4xl bg-gray-50 rounded-lg shadow-lg">
            <h2 class="text-blue-600 mb-6 text-3xl font-semibold hover:underline">
                <a href="{{ route('frontend.posts') }}">
                    &leftarrow; Kembali ke Postingan
                </a>
            </h2>

            <!-- Post Content -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold mb-4">{{ $post->title }}</h3>
                <div class="text-sm text-gray-600 mb-4">
                    <span class="font-semibold text-gray-800">Oleh</span>
                    <span class="text-blue-600 hover:text-blue-800">
                        <a href="#">{{ $post->user->name }}</a>
                    </span>
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $post->created_at->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
                <div class="prose max-w-none my-6">{!! $post->content !!}</div>
            </div>

            <!-- Comment Form -->
            <div class="bg-white p-6 mt-8 rounded-lg shadow-md">
                @auth
                    <h3 class="text-xl font-semibold mb-4">Tambahkan Komentar</h3>
                    <form method="POST" action="{{ route('comments.store', $post->slug) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 font-medium mb-2">
                                Komentar:
                            </label>
                            <textarea id="comment" name="comment" rows="4"
                                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Tulis komentar Anda..."></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700 transition">
                            Kirim Komentar
                        </button>
                    </form>
                @else
                    <p class="text-red-500 font-medium">Silakan
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">LOGIN</a>
                        atau
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">DAFTAR</a>
                        untuk memberikan komentar.
                    </p>
                @endauth
            </div>

            <!-- Comments Section -->
            <div class="bg-white p-6 mt-8 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Komentar</h3>
                @forelse ($post->comments as $comment)
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <p class="font-semibold text-blue-600">{{ $comment->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                        <p class="mt-2 text-gray-800">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada komentar. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-user-layout>
