<x-user-layout>
    <div class="my-8">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800 tracking-wide">📰 Postingan</h1>

            <!-- Search Component -->
            @include('frontend.posts.components.search')

            <!-- Post Section -->
            <div class="mt-8" id="post-container">
                @include('frontend.posts.components.posts')
            </div>
        </div>
    </div>
</x-user-layout>
