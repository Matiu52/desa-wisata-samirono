<x-user-layout>
    <div class="my-8">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-blue-600 mb-6 text-3xl font-semibold hover:underline">
                <a href="{{ route('frontend.posts') }}">
                    &leftarrow; Kembali ke Postingan
                </a>
            </h2>
            <h1 class="text-3xl font-bold mb-6">Post oleh {{ $user->name }}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div
                        class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col relative hover:shadow-lg transition-shadow duration-300">
                        @if ($post->image)
                            <div class="relative"> <img class="w-full h-48 object-cover" src="{{ $post->image }}"
                                    alt="{{ $post->title }}">
                                <div class="absolute bottom-0 left-0 bg-gray-900 bg-opacity-75 p-2 w-full text-white">
                                    <p class="text-sm font-medium"> Oleh
                                        <a href="{{ route('authors.posts.show', urlencode($post->user->name)) }}"
                                            class="hover:underline">{{ $post->user->name }}
                                        </a>
                                    </p>
                                    <div class="flex space-x-1 text-sm">
                                        <span>{{ $post->created_at->isoFormat('dddd, D MMMM YYYY') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold mb-2">
                                    <a href="{{ route('frontend.posts.show', $post->slug) }}"
                                        class="hover:underline">{{ $post->title }}
                                    </a>
                                </h2>
                                <p class="text-gray-700">
                                    {{ Str::limit(str_replace('&nbsp;', '', strip_tags($post->content)), 100) }} </p>
                            </div>
                            <div class="flex justify-end items-end mt-auto"> <a
                                    href="{{ route('frontend.posts.show', $post->slug) }}"
                                    class="text-blue-500 hover:underline">Baca Selengkapnya &rightarrow;</a> </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6"> {{ $posts->links('vendor.pagination.tailwind') }} </div>
        </div>
    </div>
</x-user-layout>
